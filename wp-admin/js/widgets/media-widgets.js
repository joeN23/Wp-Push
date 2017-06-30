/* eslint consistent-this: [ "error", "control" ] */
wp.mediaWidgets = ( function( $ ) {
	'use strict';

	var component = {};

	/**
	 * Widget control (view) constructors, mapping widget id_base to subclass of MediaWidgetControl.
	 *
	 * Media widgets register themselves by assigning subclasses of MediaWidgetControl onto this object by widget ID base.
	 *
	 * @type {Object.<string, wp.mediaWidgets.MediaWidgetModel>}
	 */
	component.controlConstructors = {};

	/**
	 * Widget model constructors, mapping widget id_base to subclass of MediaWidgetModel.
	 *
	 * Media widgets register themselves by assigning subclasses of MediaWidgetControl onto this object by widget ID base.
	 *
	 * @type {Object.<string, wp.mediaWidgets.MediaWidgetModel>}
	 */
	component.modelConstructors = {};

	/**
	 * Library which persists the customized display settings across selections.
	 *
	 * @class PersistentDisplaySettingsLibrary
	 * @constructor
	 */
	component.PersistentDisplaySettingsLibrary = wp.media.controller.Library.extend({

		/**
		 * Initialize.
		 *
		 * @param {Object} options - Options.
		 * @returns {void}
		 */
		initialize: function initialize( options ) {
			_.bindAll( this, 'handleDisplaySettingChange' );
			wp.media.controller.Library.prototype.initialize.call( this, options );
		},

		/**
		 * Sync changes to the current display settings back into the current customized.
		 *
		 * @param {Backbone.Model} displaySettings - Modified display settings.
		 * @returns {void}
		 */
		handleDisplaySettingChange: function handleDisplaySettingChange( displaySettings ) {
			this.get( 'selectedDisplaySettings' ).set( displaySettings.attributes );
		},

		/**
		 * Get the display settings model.
		 *
		 * Model returned is updated with the current customized display settings,
		 * and an event listener is added so that changes made to the settings
		 * will sync back into the model storing the session's customized display
		 * settings.
		 *
		 * @param {Backbone.Model} model - Display settings model.
		 * @returns {Backbone.Model} Display settings model.
		 */
		display: function getDisplaySettingsModel( model ) {
			var display, selectedDisplaySettings = this.get( 'selectedDisplaySettings' );
			display = wp.media.controller.Library.prototype.display.call( this, model );

			display.off( 'change', this.handleDisplaySettingChange ); // Prevent duplicated event handlers.
			display.set( selectedDisplaySettings.attributes );
			if ( 'custom' === selectedDisplaySettings.get( 'link_type' ) ) {
				display.linkUrl = selectedDisplaySettings.get( 'link_url' );
			}
			display.on( 'change', this.handleDisplaySettingChange );
			return display;
		}
	});

	/**
	 * Extended view for managing the embed UI.
	 *
	 * @class MediaEmbedView
	 * @constructor
	 */
	component.MediaEmbedView = wp.media.view.Embed.extend({

		/**
		 * Refresh embed view.
		 *
		 * Forked override of {wp.media.view.Embed#refresh()} to suppress irrelevant "link text" field.
		 *
		 * @returns {void}
		 */
		refresh: function refresh() {
			var Constructor;

			if ( 'image' === this.controller.options.mimeType ) {
				Constructor = wp.media.view.EmbedImage;
			} else {

				// This should be eliminated once #40450 lands of when this is merged into core.
				Constructor = wp.media.view.EmbedLink.extend({

					/**
					 * Set the disabled state on the Add to Widget button.
					 *
					 * @param {boolean} disabled - Disabled.
					 * @returns {void}
					 */
					setAddToWidgetButtonDisabled: function setAddToWidgetButtonDisabled( disabled ) {
						this.views.parent.views.parent.views.get( '.media-frame-toolbar' )[0].$el.find( '.media-button-select' ).prop( 'disabled', disabled );
					},

					/**
					 * Set or clear an error notice.
					 *
					 * @param {string} notice - Notice.
					 * @returns {void}
					 */
					setErrorNotice: function setErrorNotice( notice ) {
						var embedLinkView = this, noticeContainer; // eslint-disable-line consistent-this

						noticeContainer = embedLinkView.views.parent.$el.find( '> .notice:first-child' );
						if ( ! notice ) {
							if ( noticeContainer.length ) {
								noticeContainer.slideUp( 'fast' );
							}
						} else {
							if ( ! noticeContainer.length ) {
								noticeContainer = $( '<div class="media-widget-embed-notice notice notice-error notice-alt"></div>' );
								noticeContainer.hide();
								embedLinkView.views.parent.$el.prepend( noticeContainer );
							}
							noticeContainer.empty();
							noticeContainer.append( $( '<p>', {
								html: notice
							}));
							noticeContainer.slideDown( 'fast' );
						}
					},

					/**
					 * Fetch media.
					 *
					 * @returns {void}
					 */
					fetch: function() {
						var embedLinkView = this, fetchSuccess, matches, fileExt, urlParser; // eslint-disable-line consistent-this

						if ( embedLinkView.dfd && 'pending' === embedLinkView.dfd.state() ) {
							embedLinkView.dfd.abort();
						}

						// Abort if the URL field was emptied out.
						if ( ! embedLinkView.model.get( 'url' ) ) {
							embedLinkView.setErrorNotice( '' );
							return;
						}

						fetchSuccess = function( response ) {
							embedLinkView.renderoEmbed({
								data: {
									body: response
								}
							});

							$( '#embed-url-field' ).removeClass( 'invalid' );
							embedLinkView.setErrorNotice( '' );
							embedLinkView.setAddToWidgetButtonDisabled( false );
						};

						urlParser = document.createElement( 'a' );
						urlParser.href = embedLinkView.model.get( 'url' );
						matches = urlParser.pathname.toLowerCase().match( /\.(\w+)$/ );
						if ( matches ) {
							fileExt = matches[1];
							if ( ! wp.media.view.settings.embedMimes[ fileExt ] ) {
								embedLinkView.renderFail();
							} else if ( 0 !== wp.media.view.settings.embedMimes[ fileExt ].indexOf( embedLinkView.controller.options.mimeType ) ) {
								embedLinkView.renderFail();
							} else {
								fetchSuccess( '<!--success-->' );
							}
							return;
						}

						embedLinkView.dfd = $.ajax({
							url: wp.media.view.settings.oEmbedProxyUrl,
							data: {
								url: embedLinkView.model.get( 'url' ),
								maxwidth: embedLinkView.model.get( 'width' ),
								maxheight: embedLinkView.model.get( 'height' ),
								_wpnonce: wp.media.view.settings.nonce.wpRestApi,
								discover: false
							},
							type: 'GET',
							dataType: 'json',
							context: embedLinkView
						});

						embedLinkView.dfd.done( function( response ) {
							if ( embedLinkView.controller.options.mimeType !== response.type ) {
								embedLinkView.renderFail();
								return;
							}
							fetchSuccess( response.html );
						});
						embedLinkView.dfd.fail( _.bind( embedLinkView.renderFail, embedLinkView ) );
					},

					/**
					 * Handle render failure.
					 *
					 * Overrides the {EmbedLink#renderFail()} method to prevent showing the "Link Text" field.
					 * The element is getting display:none in the stylesheet, but the underlying method uses
					 * uses {jQuery.fn.show()} which adds an inline style. This avoids the need for !important.
					 *
					 * @returns {void}
					 */
					renderFail: function renderFail() {
						var embedLinkView = this; // eslint-disable-line consistent-this
						$( '#embed-url-field' ).addClass( 'invalid' );
						embedLinkView.setErrorNotice( embedLinkView.controller.options.invalidEmbedTypeError || 'ERROR' );
						embedLinkView.setAddToWidgetButtonDisabled( true );
					}
				});
			}

			this.settings( new Constructor({
				controller: this.controller,
				model:      this.model.props,
				priority:   40
			}));
		}
	});

	/**
	 * Custom media frame for selecting uploaded media or providing media by URL.
	 *
	 * @class MediaFrameSelect
	 * @constructor
	 */
	component.MediaFrameSelect = wp.media.view.MediaFrame.Post.extend({

		/**
		 * Create the default states.
		 *
		 * @returns {void}
		 */
		createStates: function createStates() {
			var mime = this.options.mimeType, specificMimes = [];
			_.each( wp.media.view.settings.embedMimes, function( embedMime ) {
				if ( 0 === embedMime.indexOf( mime ) ) {
					specificMimes.push( embedMime );
				}
			});
			if ( specificMimes.length > 0 ) {
				mime = specificMimes;
			}

			this.states.add([

				// Main states.
				new component.PersistentDisplaySettingsLibrary({
					id:         'insert',
					title:      this.options.title,
					selection:  this.options.selection,
					priority:   20,
					toolbar:    'main-insert',
					filterable: 'dates',
					library:    wp.media.query({
						type: mime
					}),
					multiple:   false,
					editable:   true,

					selectedDisplaySettings: this.options.selectedDisplaySettings,
					displaySettings: _.isUndefined( this.options.showDisplaySettings ) ? true : this.options.showDisplaySettings,
					displayUserSettings: false // We use the display settings from the current/default widget instance props.
				}),

				new wp.media.controller.EditImage({ model: this.options.editImage }),

				// Embed states.
				new wp.media.controller.Embed({
					metadata: this.options.metadata,
					type: 'image' === this.options.mimeType ? 'image' : 'link',
					invalidEmbedTypeError: this.options.invalidEmbedTypeError
				})
			]);
		},

		/**
		 * Main insert toolbar.
		 *
		 * Forked override of {wp.media.view.MediaFrame.Post#mainInsertToolbar()} to override text.
		 *
		 * @param {wp.Backbone.View} view - Toolbar view.
		 * @this {wp.media.controller.Library}
		 * @returns {void}
		 */
		mainInsertToolbar: function mainInsertToolbar( view ) {
			var controller = this; // eslint-disable-line consistent-this
			view.set( 'insert', {
				style:    'primary',
				priority: 80,
				text:     controller.options.text, // The whole reason for the fork.
				requires: { selection: true },

				/**
				 * Handle click.
				 *
				 * @fires wp.media.controller.State#insert()
				 * @returns {void}
				 */
				click: function onClick() {
					var state = controller.state(),
						selection = state.get( 'selection' );

					controller.close();
					state.trigger( 'insert', selection ).reset();
				}
			});
		},

		/**
		 * Main embed toolbar.
		 *
		 * Forked override of {wp.media.view.MediaFrame.Post#mainEmbedToolbar()} to override text.
		 *
		 * @param {wp.Backbone.View} toolbar - Toolbar view.
		 * @this {wp.media.controller.Library}
		 * @returns {void}
		 */
		mainEmbedToolbar: function mainEmbedToolbar( toolbar ) {
			toolbar.view = new wp.media.view.Toolbar.Embed({
				controller: this,
				text: this.options.text,
				event: 'insert'
			});
		},

		/**
		 * Embed content.
		 *
		 * Forked override of {wp.media.view.MediaFrame.Post#embedContent()} to suppress irrelevant "link text" field.
		 *
		 * @returns {void}
		 */
		embedContent: function embedContent() {
			var view = new component.MediaEmbedView({
				controller: this,
				model:      this.state()
			}).render();

			this.content.set( view );

			if ( ! wp.media.isTouchDevice ) {
				view.url.focus();
			}
		}
	});

	/**
	 * Media widget control.
	 *
	 * @class MediaWidgetControl
	 * @constructor
	 * @abstract
	 */
	component.MediaWidgetControl = Backbone.View.extend({

		/**
		 * Translation strings.
		 *
		 * The mapping of translation strings is handled by media widget subclasses,
		 * exported from PHP to JS such as is done in WP_Widget_Media_Image::enqueue_admin_scripts().
		 *
		 * @type {Object}
		 */
		l10n: {
			add_to_widget: '{{add_to_widget}}',
			add_media: '{{add_media}}'
		},

		/**
		 * Widget ID base.
		 *
		 * This may be defined by the subclass. It may be exported from PHP to JS
		 * such as is done in WP_Widget_Media_Image::enqueue_admin_scripts(). If not,
		 * it will attempt to be discovered by looking to see if this control
		 * instance extends each member of component.controlConstructors, and if
		 * it does extend one, will use the key as the id_base.
		 *
		 * @type {string}
		 */
		id_base: '',

		/**
		 * Mime type.
		 *
		 * This must be defined by the subclass. It may be exported from PHP to JS
		 * such as is done in WP_Widget_Media_Image::enqueue_admin_scripts().
		 *
		 * @type {string}
		 */
		mime_type: '',

		/**
		 * View events.
		 *
		 * @type {Object}
		 */
		events: {
			'click .notice-missing-attachment a': 'handleMediaLibraryLinkClick',
			'click .select-media': 'selectMedia',
			'click .edit-media': 'editMedia'
		},

		/**
		 * Show display settings.
		 *
		 * @type {boolean}
		 */
		showDisplaySettings: true,

		/**
		 * Initialize.
		 *
		 * @param {Object}         options - Options.
		 * @param {Backbone.Model} options.model - Model.
		 * @param {jQuery}         options.el - Control container element.
		 * @returns {void}
		 */
		initialize: function initialize( options ) {
			var control = this;

			Backbone.View.prototype.initialize.call( control, options );

			if ( ! control.el ) {
				throw new Error( 'Missing options.el' );
			}
			if ( ! ( control.model instanceof component.MediaWidgetModel ) ) {
				throw new Error( 'Missing options.model' );
			}

			// Allow methods to be passed in with control context preserved.
			_.bindAll( control, 'syncModelToInputs', 'render', 'updateSelectedAttachment', 'renderPreview' );

			if ( ! control.id_base ) {
				_.find( component.controlConstructors, function( Constructor, idBase ) {
					if ( control instanceof Constructor ) {
						control.id_base = idBase;
						return true;
					}
					return false;
				});
				if ( ! control.id_base ) {
					throw new Error( 'Missing id_base.' );
				}
			}

			// Track attributes needed to renderPreview in it's own model.
			control.previewTemplateProps = new Backbone.Model( control.mapModelToPreviewTemplateProps() );

			// Re-render the preview when the attachment changes.
			control.selectedAttachment = new wp.media.model.Attachment();
			control.renderPreview = _.debounce( control.renderPreview );
			control.listenTo( control.previewTemplateProps, 'change', control.renderPreview );

			// Make sure a copy of the selected attachment is always fetched.
			control.model.on( 'change:attachment_id', control.updateSelectedAttachment );
			control.model.on( 'change:url', control.updateSelectedAttachment );
			control.updateSelectedAttachment();

			/*
			 * Sync the widget instance model attributes onto the hidden inputs that widgets currently use to store the state.
			 * In the future, when widgets are JS-driven, the underlying widget instance data should be exposed as a model
			 * from the start, without having to sync with hidden fields. See <https://core.trac.wordpress.org/ticket/33507>.
			 */
			control.listenTo( control.model, 'change', control.syncModelToInputs );
			control.listenTo( control.model, 'change', control.syncModelToPreviewProps );
			control.listenTo( control.model, 'change', control.render );

			// Update the title.
			control.$el.on( 'input change', '.title', function updateTitle() {
				control.model.set({
					title: $.trim( $( this ).val() )
				});
			});

			/*
			 * Copy current display settings from the widget model to serve as basis
			 * of customized display settings for the current media frame session.
			 * Changes to display settings will be synced into this model, and
			 * when a new selection is made, the settings from this will be synced
			 * into that AttachmentDisplay's model to persist the setting changes.
			 */
			control.displaySettings = new Backbone.Model( _.pick(
				control.mapModelToMediaFrameProps(
					_.extend( control.model.defaults(), control.model.toJSON() )
				),
				_.keys( wp.media.view.settings.defaultProps )
			) );
		},

		/**
		 * Update the selected attachment if necessary.
		 *
		 * @returns {void}
		 */
		updateSelectedAttachment: function updateSelectedAttachment() {
			var control = this, attachment;

			if ( 0 === control.model.get( 'attachment_id' ) ) {
				control.selectedAttachment.clear();
				control.model.set( 'error', false );
			} else if ( control.model.get( 'attachment_id' ) !== control.selectedAttachment.get( 'id' ) ) {
				attachment = new wp.media.model.Attachment({
					id: control.model.get( 'attachment_id' )
				});
				attachment.fetch()
					.done( function done() {
						control.model.set( 'error', false );
						control.selectedAttachment.set( attachment.toJSON() );
					})
					.fail( function fail() {
						control.model.set( 'error', 'missing_attachment' );
					});
			}
		},

		/**
		 * Sync the model attributes to the hidden inputs, and update previewTemplateProps.
		 *
		 * @returns {void}
		 */
		syncModelToPreviewProps: function syncModelToPreviewProps() {
			var control = this;
			control.previewTemplateProps.set( control.mapModelToPreviewTemplateProps() );
		},

		/**
		 * Sync the model attributes to the hidden inputs, and update previewTemplateProps.
		 *
		 * @returns {void}
		 */
		syncModelToInputs: function syncModelToInputs() {
			var control = this;
			control.$el.next( '.widget-content' ).find( '.media-widget-instance-property' ).each( function() {
				var input = $( this ), value;
				value = control.model.get( input.data( 'property' ) );
				if ( _.isUndefined( value ) ) {
					return;
				}
				value = String( value );
				if ( input.val() === value ) {
					return;
				}
				input.val( value );
				input.trigger( 'change' );
			});
		},

		/**
		 * Get template.
		 *
		 * @returns {Function} Template.
		 */
		template: function template() {
			var control = this;
			if ( ! $( '#tmpl-widget-media-' + control.id_base + '-control' ).length ) {
				throw new Error( 'Missing widget control template for ' + control.id_base );
			}
			return wp.template( 'widget-media-' + control.id_base + '-control' );
		},

		/**
		 * Render template.
		 *
		 * @returns {void}
		 */
		render: function render() {
			var control = this, titleInput;

			if ( ! control.templateRendered ) {
				control.$el.html( control.template()( control.model.toJSON() ) );
				control.renderPreview(); // Hereafter it will re-render when control.selectedAttachment changes.
				control.templateRendered = true;
			}

			titleInput = control.$el.find( '.title' );
			if ( ! titleInput.is( document.activeElement ) ) {
				titleInput.val( control.model.get( 'title' ) );
			}

			control.$el.toggleClass( 'selected', control.isSelected() );
		},

		/**
		 * Render media preview.
		 *
		 * @abstract
		 * @returns {void}
		 */
		renderPreview: function renderPreview() {
			throw new Error( 'renderPreview must be implemented' );
		},

		/**
		 * Whether a media item is selected.
		 *
		 * @returns {boolean} Whether selected and no error.
		 */
		isSelected: function isSelected() {
			var control = this;

			if ( control.model.get( 'error' ) ) {
				return false;
			}

			return Boolean( control.model.get( 'attachment_id' ) || control.model.get( 'url' ) );
		},

		/**
		 * Handle click on link to Media Library to open modal, such as the link that appears when in the missing attachment error notice.
		 *
		 * @param {jQuery.Event} event - Event.
		 * @returns {void}
		 */
		handleMediaLibraryLinkClick: function handleMediaLibraryLinkClick( event ) {
			var control = this;
			event.preventDefault();
			control.selectMedia();
		},

		/**
		 * Open the media select frame to chose an item.
		 *
		 * @returns {void}
		 */
		selectMedia: function selectMedia() {
			var control = this, selection, mediaFrame, defaultSync, mediaFrameProps, selectionModels = [];

			if ( control.isSelected() && 0 !== control.model.get( 'attachment_id' ) ) {
				selectionModels.push( control.selectedAttachment );
			}

			selection = new wp.media.model.Selection( selectionModels, { multiple: false } );

			mediaFrameProps = control.mapModelToMediaFrameProps( control.model.toJSON() );
			if ( mediaFrameProps.size ) {
				control.displaySettings.set( 'size', mediaFrameProps.size );
			}

			mediaFrame = new component.MediaFrameSelect({
				title: control.l10n.add_media,
				frame: 'post',
				text: control.l10n.add_to_widget,
				selection: selection,
				mimeType: control.mime_type,
				selectedDisplaySettings: control.displaySettings,
				showDisplaySettings: control.showDisplaySettings,
				metadata: mediaFrameProps,
				state: control.isSelected() && 0 === control.model.get( 'attachment_id' ) ? 'embed' : 'insert',
				invalidEmbedTypeError: control.l10n.unsupported_file_type
			});
			wp.media.frame = mediaFrame; // See wp.media().

			// Handle selection of a media item.
			mediaFrame.on( 'insert', function onInsert() {
				var attachment = {}, state = mediaFrame.state();

				// Update cached attachment object to avoid having to re-fetch. This also triggers re-rendering of preview.
				if ( 'embed' === state.get( 'id' ) ) {
					_.extend( attachment, { id: 0 }, state.props.toJSON() );
				} else {
					_.extend( attachment, state.get( 'selection' ).first().toJSON() );
				}

				control.selectedAttachment.set( attachment );
				control.model.set( 'error', false );

				// Update widget instance.
				control.model.set( control.getModelPropsFromMediaFrame( mediaFrame ) );
			});

			// Disable syncing of attachment changes back to server. See <https://core.trac.wordpress.org/ticket/40403>.
			defaultSync = wp.media.model.Attachment.prototype.sync;
			wp.media.model.Attachment.prototype.sync = function rejectedSync() {
				return $.Deferred().rejectWith( this ).promise();
			};
			mediaFrame.on( 'close', function onClose() {
				wp.media.model.Attachment.prototype.sync = defaultSync;
			});

			mediaFrame.$el.addClass( 'media-widget' );
			mediaFrame.open();

			// Clear the selected attachment when it is deleted in the media select frame.
			if ( selection ) {
				selection.on( 'destroy', function onDestroy( attachment ) {
					if ( control.model.get( 'attachment_id' ) === attachment.get( 'id' ) ) {
						control.model.set({
							attachment_id: 0,
							url: ''
						});
					}
				});
			}

			/*
			 * Make sure focus is set inside of modal so that hitting Esc will close
			 * the modal and not inadvertently cause the widget to collapse in the customizer.
			 */
			mediaFrame.$el.find( '.media-frame-menu .media-menu-item.active' ).focus();
		},

		/**
		 * Get the instance props from the media selection frame.
		 *
		 * @param {wp.media.view.MediaFrame.Select} mediaFrame - Select frame.
		 * @returns {Object} Props.
		 */
		getModelPropsFromMediaFrame: function getModelPropsFromMediaFrame( mediaFrame ) {
			var control = this, state, mediaFrameProps, modelProps;

			state = mediaFrame.state();
			if ( 'insert' === state.get( 'id' ) ) {
				mediaFrameProps = state.get( 'selection' ).first().toJSON();
				mediaFrameProps.postUrl = mediaFrameProps.link;

				if ( control.showDisplaySettings ) {
					_.extend(
						mediaFrameProps,
						mediaFrame.content.get( '.attachments-browser' ).sidebar.get( 'display' ).model.toJSON()
					);
				}
				if ( mediaFrameProps.sizes && mediaFrameProps.size && mediaFrameProps.sizes[ mediaFrameProps.size ] ) {
					mediaFrameProps.url = mediaFrameProps.sizes[ mediaFrameProps.size ].url;
				}
			} else if ( 'embed' === state.get( 'id' ) ) {
				mediaFrameProps = _.extend(
					state.props.toJSON(),
					{ attachment_id: 0 }, // Because some media frames use `attachment_id` not `id`.
					control.model.getEmbedResetProps()
				);
			} else {
				throw new Error( 'Unexpected state: ' + state.get( 'id' ) );
			}

			if ( mediaFrameProps.id ) {
				mediaFrameProps.attachment_id = mediaFrameProps.id;
			}

			modelProps = control.mapMediaToModelProps( mediaFrameProps );

			// Clear the extension prop so sources will be reset for video and audio media.
			_.each( wp.media.view.settings.embedExts, function( ext ) {
				if ( ext in control.model.schema && modelProps.url !== modelProps[ ext ] ) {
					modelProps[ ext ] = '';
				}
			});

			return modelProps;
		},

		/**
		 * Map media frame props to model props.
		 *
		 * @param {Object} mediaFrameProps - Media frame props.
		 * @returns {Object} Model props.
		 */
		mapMediaToModelProps: function mapMediaToModelProps( mediaFrameProps ) {
			var control = this, mediaFramePropToModelPropMap = {}, modelProps = {}, extension;
			_.each( control.model.schema, function( fieldSchema, modelProp ) {

				// Ignore widget title attribute.
				if ( 'title' === modelProp ) {
					return;
				}
				mediaFramePropToModelPropMap[ fieldSchema.media_prop || modelProp ] = modelProp;
			});

			_.each( mediaFrameProps, function( value, mediaProp ) {
				var propName = mediaFramePropToModelPropMap[ mediaProp ] || mediaProp;
				if ( control.model.schema[ propName ] ) {
					modelProps[ propName ] = value;
				}
			});

			if ( 'custom' === mediaFrameProps.size ) {
				modelProps.width = mediaFrameProps.customWidth;
				modelProps.height = mediaFrameProps.customHeight;
			}

			if ( 'post' === mediaFrameProps.link ) {
				modelProps.link_url = mediaFrameProps.postUrl;
			} else if ( 'file' === mediaFrameProps.link ) {
				modelProps.link_url = mediaFrameProps.url;
			}

			// Because some media frames use `id` instead of `attachment_id`.
			if ( ! mediaFrameProps.attachment_id && mediaFrameProps.id ) {
				modelProps.attachment_id = mediaFrameProps.id;
			}

			if ( mediaFrameProps.url ) {
				extension = mediaFrameProps.url.replace( /#.*$/, '' ).replace( /\?.*$/, '' ).split( '.' ).pop().toLowerCase();
				if ( extension in control.model.schema ) {
					modelProps[ extension ] = mediaFrameProps.url;
				}
			}

			// Always omit the titles derived from mediaFrameProps.
			return _.omit( modelProps, 'title' );
		},

		/**
		 * Map model props to media frame props.
		 *
		 * @param {Object} modelProps - Model props.
		 * @returns {Object} Media frame props.
		 */
		mapModelToMediaFrameProps: function mapModelToMediaFrameProps( modelProps ) {
			var control = this, mediaFrameProps = {};

			_.each( modelProps, function( value, modelProp ) {
				var fieldSchema = control.model.schema[ modelProp ] || {};
				mediaFrameProps[ fieldSchema.media_prop || modelProp ] = value;
			});

			// Some media frames use attachment_id.
			mediaFrameProps.attachment_id = mediaFrameProps.id;

			if ( 'custom' === mediaFrameProps.size ) {
				mediaFrameProps.customWidth = control.model.get( 'width' );
				mediaFrameProps.customHeight = control.model.get( 'height' );
			}

			return mediaFrameProps;
		},

		/**
		 * Map model props to previewTemplateProps.
		 *
		 * @returns {Object} Preview Template Props.
		 */
		mapModelToPreviewTemplateProps: function mapModelToPreviewTemplateProps() {
			var control = this, previewTemplateProps = {};
			_.each( control.model.schema, function( value, prop ) {
				if ( ! value.hasOwnProperty( 'should_preview_update' ) || value.should_preview_update ) {
					previewTemplateProps[ prop ] = control.model.get( prop );
				}
			});

			// Templates need to be aware of the error.
			previewTemplateProps.error = control.model.get( 'error' );
			return previewTemplateProps;
		},

		/**
		 * Open the media frame to modify the selected item.
		 *
		 * @abstract
		 * @returns {void}
		 */
		editMedia: function editMedia() {
			throw new Error( 'editMedia not implemented' );
		}
	});

	/**
	 * Media widget model.
	 *
	 * @class MediaWidgetModel
	 * @constructor
	 */
	component.MediaWidgetModel = Backbone.Model.extend({

		/**
		 * Id attribute.
		 *
		 * @type {string}
		 */
		idAttribute: 'widget_id',

		/**
		 * Instance schema.
		 *
		 * This adheres to JSON Schema and subclasses should have their schema
		 * exported from PHP to JS such as is done in WP_Widget_Media_Image::enqueue_admin_scripts().
		 *
		 * @type {Object.<string, Object>}
		 */
		schema: {
			title: {
				type: 'string',
				'default': ''
			},
			attachment_id: {
				type: 'integer',
				'default': 0
			},
			url: {
				type: 'string',
				'default': ''
			}
		},

		/**
		 * Get default attribute values.
		 *
		 * @returns {Object} Mapping of property names to their default values.
		 */
		defaults: function() {
			var defaults = {};
			_.each( this.schema, function( fieldSchema, field ) {
				defaults[ field ] = fieldSchema['default'];
			});
			return defaults;
		},

		/**
		 * Set attribute value(s).
		 *
		 * This is a wrapped version of Backbone.Model#set() which allows us to
		 * cast the attribute values from the hidden inputs' string values into
		 * the appropriate data types (integers or booleans).
		 *
		 * @param {string|Object} key - Attribute name or attribute pairs.
		 * @param {mixed|Object}  [val] - Attribute value or options object.
		 * @param {Object}        [options] - Options when attribute name and value are passed separately.
		 * @returns {wp.mediaWidgets.MediaWidgetModel} This model.
		 */
		set: function set( key, val, options ) {
			var model = this, attrs, opts, castedAttrs; // eslint-disable-line consistent-this
			if ( null === key ) {
				return model;
			}
			if ( 'object' === typeof key ) {
				attrs = key;
				opts = val;
			} else {
				attrs = {};
				attrs[ key ] = val;
				opts = options;
			}

			castedAttrs = {};
			_.each( attrs, function( value, name ) {
				var type;
				if ( ! model.schema[ name ] ) {
					castedAttrs[ name ] = value;
					return;
				}
				type = model.schema[ name ].type;
				if ( 'integer' === type ) {
					castedAttrs[ name ] = parseInt( value, 10 );
				} else if ( 'boolean' === type ) {
					castedAttrs[ name ] = ! ( ! value || '0' === value || 'false' === value );
				} else {
					castedAttrs[ name ] = value;
				}
			});

			return Backbone.Model.prototype.set.call( this, castedAttrs, opts );
		},

		/**
		 * Get props which are merged on top of the model when an embed is chosen (as opposed to an attachment).
		 *
		 * @returns {Object} Reset/override props.
		 */
		getEmbedResetProps: function getEmbedResetProps() {
			return {
				id: 0
			};
		}
	});

	/**
	 * Collection of all widget model instances.
	 *
	 * @type {Backbone.Collection}
	 */
	component.modelCollection = new ( Backbone.Collection.extend({
		model: component.MediaWidgetModel
	}) )();

	/**
	 * Mapping of widget ID to instances of MediaWidgetControl subclasses.
	 *
	 * @type {Object.<string, wp.mediaWidgets.MediaWidgetControl>}
	 */
	component.widgetControls = {};

	/**
	 * Handle widget being added or initialized for the first time at the widget-added event.
	 *
	 * @param {jQuery.Event} event - Event.
	 * @param {jQuery}       widgetContainer - Widget container element.
	 * @returns {void}
	 */
	component.handleWidgetAdded = function handleWidgetAdded( event, widgetContainer ) {
		var widgetContent, controlContainer, widgetForm, idBase, ControlConstructor, ModelConstructor, modelAttributes, widgetControl, widgetModel, widgetId, widgetInside, animatedCheckDelay = 50, renderWhenAnimationDone;
		widgetForm = widgetContainer.find( '> .widget-inside > .form, > .widget-inside > form' ); // Note: '.form' appears in the customizer, whereas 'form' on the widgets admin screen.
		widgetContent = widgetForm.find( '> .widget-content' );
		idBase = widgetForm.find( '> .id_base' ).val();
		widgetId = widgetForm.find( '> .widget-id' ).val();

		// Prevent initializing already-added widgets.
		if ( component.widgetControls[ widgetId ] ) {
			return;
		}

		ControlConstructor = component.controlConstructors[ idBase ];
		if ( ! ControlConstructor ) {
			return;
		}

		ModelConstructor = component.modelConstructors[ idBase ] || component.MediaWidgetModel;

		/*
		 * Create a container element for the widget control (Backbone.View).
		 * This is inserted into the DOM immediately before the the .widget-content
		 * element because the contents of this element are essentially "managed"
		 * by PHP, where each widget update cause the entire element to be emptied
		 * and replaced with the rendered output of WP_Widget::form() which is
		 * sent back in Ajax request made to save/update the widget instance.
		 * To prevent a "flash of replaced DOM elements and re-initialized JS
		 * components", the JS template is rendered outside of the normal form
		 * container.
		 */
		controlContainer = $( '<div class="media-widget-control"></div>' );
		widgetContent.before( controlContainer );

		/*
		 * Sync the widget instance model attributes onto the hidden inputs that widgets currently use to store the state.
		 * In the future, when widgets are JS-driven, the underlying widget instance data should be exposed as a model
		 * from the start, without having to sync with hidden fields. See <https://core.trac.wordpress.org/ticket/33507>.
		 */
		modelAttributes = {};
		widgetContent.find( '.media-widget-instance-property' ).each( function() {
			var input = $( this );
			modelAttributes[ input.data( 'property' ) ] = input.val();
		});
		modelAttributes.widget_id = widgetId;

		widgetModel = new ModelConstructor( modelAttributes );

		widgetControl = new ControlConstructor({
			el: controlContainer,
			model: widgetModel
		});

		/*
		 * Render the widget once the widget parent's container finishes animating,
		 * as the widget-added event fires with a slideDown of the container.
		 * This ensures that the container's dimensions are fixed so that ME.js
		 * can initialize with the proper dimensions.
		 */
		widgetInside = widgetContainer.parent();
		renderWhenAnimationDone = function() {
			if ( widgetInside.is( ':animated' ) ) {
				setTimeout( renderWhenAnimationDone, animatedCheckDelay );
			} else {
				widgetControl.render();
			}
		};
		renderWhenAnimationDone();

		/*
		 * Note that the model and control currently won't ever get garbage-collected
		 * when a widget gets removed/deleted because there is no widget-removed event.
		 */
		component.modelCollection.add( [ widgetModel ] );
		component.widgetControls[ widgetModel.get( 'widget_id' ) ] = widgetControl;
	};

	/**
	 * Sync widget instance data sanitized from server back onto widget model.
	 *
	 * This gets called via the 'widget-updated' event when saving a widget from
	 * the widgets admin screen and also via the 'widget-synced' event when making
	 * a change to a widget in the customizer.
	 *
	 * @param {jQuery.Event} event - Event.
	 * @param {jQuery}       widgetContainer - Widget container element.
	 * @returns {void}
	 */
	component.handleWidgetUpdated = function handleWidgetUpdated( event, widgetContainer ) {
		var widgetForm, widgetContent, widgetId, widgetControl, attributes = {};
		widgetForm = widgetContainer.find( '> .widget-inside > .form, > .widget-inside > form' );
		widgetId = widgetForm.find( '> .widget-id' ).val();

		widgetControl = component.widgetControls[ widgetId ];
		if ( ! widgetControl ) {
			return;
		}

		// Make sure the server-sanitized values get synced back into the model.
		widgetContent = widgetForm.find( '> .widget-content' );
		widgetContent.find( '.media-widget-instance-property' ).each( function() {
			var property = $( this ).data( 'property' );
			attributes[ property ] = $( this ).val();
		});

		// Suspend syncing model back to inputs when syncing from inputs to model, preventing infinite loop.
		widgetControl.stopListening( widgetControl.model, 'change', widgetControl.syncModelToInputs );
		widgetControl.model.set( attributes );
		widgetControl.listenTo( widgetControl.model, 'change', widgetControl.syncModelToInputs );
	};

	/**
	 * Initialize functionality.
	 *
	 * This function exists to prevent the JS file from having to boot itself.
	 * When WordPress enqueues this script, it should have an inline script
	 * attached which calls wp.mediaWidgets.init().
	 *
	 * @returns {void}
	 */
	component.init = function init() {
		var $document = $( document );
		$document.on( 'widget-added', component.handleWidgetAdded );
		$document.on( 'widget-synced widget-updated', component.handleWidgetUpdated );

		/*
		 * Manually trigger widget-added events for media widgets on the admin
		 * screen once they are expanded. The widget-added event is not triggered
		 * for each pre-existing widget on the widgets admin screen like it is
		 * on the customizer. Likewise, the customizer only triggers widget-added
		 * when the widget is expanded to just-in-time construct the widget form
		 * when it is actually going to be displayed. So the following implements
		 * the same for the widgets admin screen, to invoke the widget-added
		 * handler when a pre-existing media widget is expanded.
		 */
		$( function initializeExistingWidgetContainers() {
			var widgetContainers;
			if ( 'widgets' !== window.pagenow ) {
				return;
			}
			widgetContainers = $( '.widgets-holder-wrap:not(#available-widgets)' ).find( 'div.widget' );
			widgetContainers.one( 'click.toggle-widget-expanded', function toggleWidgetExpanded() {
				var widgetContainer = $( this );
				component.handleWidgetAdded( new jQuery.Event( 'widget-added' ), widgetContainer );
			});
		});
	};

	return component;
})( jQuery );
