import { FontAwesomeEnabled } from "../settings";
import PremiumTypo from "../../components/premium-typo";
import FontIconPicker from "@fonticonpicker/react-fonticonpicker";
import iconsList from "../../components/premium-icons-list";
import PremiumBorder from "../../components/premium-border";
import PremiumPadding from "../../components/premium-padding";
import PremiumMargin from "../../components/premium-margin";
import PremiumTextShadow from "../../components/premium-text-shadow";
import PremiumBoxShadow from "../../components/premium-box-shadow";
import PremiumBackgroud from "../../components/premium-background";

const className = "premium-icon-box";

const { __ } = wp.i18n;

const { registerBlockType } = wp.blocks;

const {
  PanelBody,
  IconButton,
  Toolbar,
  RangeControl,
  SelectControl,
  ToggleControl
} = wp.components;

const { Fragment } = wp.element;

const {
  InspectorControls,
  RichText,
  PanelColorSettings,
  MediaUpload,
  URLInput
} = wp.editor;

const edit = props => {
  const { isSelected, setAttributes, clientId: blockId } = props;
  const {
    id,
    align,
    iconChecked,
    iconImage,
    iconImgId,
    iconImgUrl,
    iconType,
    selectedIcon,
    hoverEffect,
    iconSize,
    iconRadius,
    iconColor,
    titleChecked,
    titleText,
    titleTag,
    titleColor,
    titleSize,
    titleLine,
    titleLetter,
    titleStyle,
    titleUpper,
    titleWeight,
    titleShadowBlur,
    titleShadowColor,
    titleShadowHorizontal,
    titleShadowVertical,
    titleMarginT,
    titleMarginB,
    descChecked,
    descText,
    descColor,
    descSize,
    descLine,
    descWeight,
    descMarginT,
    descMarginB,
    btnChecked,
    btnEffect,
    effectDir,
    btnTarget,
    btnText,
    btnLink,
    btnSize,
    btnUpper,
    btnWeight,
    btnLetter,
    btnColor,
    btnStyle,
    btnHoverColor,
    btnBack,
    btnHoverBack,
    btnHoverBorder,
    btnBorderColor,
    btnBorderWidth,
    btnBorderRadius,
    btnBorderType,
    btnPadding,
    btnMarginT,
    btnMarginB,
    btnShadowBlur,
    btnShadowColor,
    btnShadowHorizontal,
    btnShadowVertical,
    btnShadowPosition,
    imageID,
    imageURL,
    fixed,
    backColor,
    backgroundRepeat,
    backgroundPosition,
    backgroundSize,
    borderType,
    borderWidth,
    borderRadius,
    borderColor,
    marginT,
    marginR,
    marginB,
    marginL,
    paddingT,
    paddingR,
    paddingB,
    paddingL,
    shadowBlur,
    shadowColor,
    shadowHorizontal,
    shadowVertical,
    shadowPosition
  } = props.attributes;

  setAttributes({ id: blockId });

  const imgIcon = [
    {
      label: __("Icon"),
      value: "icon"
    },
    {
      label: __("Image"),
      value: "image"
    }
  ];

  const ALIGNS = ["left", "center", "right"];

  const EFFECTS = [
    {
      value: "none",
      label: __("None")
    },
    {
      value: "pulse",
      label: __("Pulse")
    },
    {
      value: "rotate",
      label: __("Rotate")
    },
    {
      value: "drotate",
      label: __("3D Rotate")
    },
    {
      value: "buzz",
      label: __("Buzz")
    },
    {
      value: "drop",
      label: __("Drop Shadow")
    },
    {
      value: "wobble",
      label: __("Wobble")
    }
  ];

  const BTN_EFFECTS = [
    {
      value: "none",
      label: __("None")
    },
    {
      value: "slide",
      label: __("Slide")
    }
  ];

  const DIRECTION = [
    {
      value: "top",
      label: __("Top to Bottom")
    },
    {
      value: "bottom",
      label: __("Bottom to Top")
    },
    {
      value: "left",
      label: __("Left to Right")
    },
    {
      value: "right",
      label: __("Right to Left")
    }
  ];

  return [
    isSelected && (
      <InspectorControls key={"inspector"}>
        <PanelBody
          title={__("Display Options")}
          className="premium-panel-body"
          initialOpen={false}
        >
          <ToggleControl
            label={__("Icon")}
            checked={iconChecked}
            onChange={newValue => setAttributes({ iconChecked: newValue })}
          />
          <ToggleControl
            label={__("Title")}
            checked={titleChecked}
            onChange={newValue => setAttributes({ titleChecked: newValue })}
          />
          <ToggleControl
            label={__("Description")}
            checked={descChecked}
            onChange={newValue => setAttributes({ descChecked: newValue })}
          />
          <ToggleControl
            label={__("Button")}
            checked={btnChecked}
            onChange={newValue => setAttributes({ btnChecked: newValue })}
          />
        </PanelBody>
        {iconChecked && (
          <PanelBody
            title={__("Icon")}
            className="premium-panel-body"
            initialOpen={false}
          >
            <SelectControl
              label={__("Icon Type")}
              options={imgIcon}
              value={iconImage}
              onChange={newType => setAttributes({ iconImage: newType })}
            />
            {"icon" === iconImage && (
              <Fragment>
                <p className="premium-editor-paragraph">{__("Select Icon")}</p>
                <FontIconPicker
                  icons={iconsList}
                  onChange={newIcon => setAttributes({ selectedIcon: newIcon })}
                  value={selectedIcon}
                  isMulti={false}
                  appendTo="body"
                  noSelectedPlaceholder={__("Select Icon")}
                />
                <PanelColorSettings
                  title={__("Colors")}
                  className="premium-panel-body-inner"
                  initialOpen={false}
                  colorSettings={[
                    {
                      value: iconColor,
                      onChange: colorValue =>
                        setAttributes({ iconColor: colorValue }),
                      label: __("Icon Color")
                    }
                  ]}
                />
              </Fragment>
            )}
            {"image" === iconImage && (
              <Fragment>
                {iconImgUrl && (
                  <img src={iconImgUrl} width="100%" height="auto" />
                )}
                <MediaUpload
                  allowedTypes={["image"]}
                  onSelect={media => {
                    setAttributes({
                      iconImgId: media.id,
                      iconImgUrl:
                        "undefined" === typeof media.sizes.thumbnail
                          ? media.url
                          : media.sizes.thumbnail.url
                    });
                  }}
                  type="image"
                  value={iconImgId}
                  render={({ open }) => (
                    <IconButton
                      label={__("Change Image")}
                      icon="edit"
                      onClick={open}
                    >
                      {__("Change Image")}
                    </IconButton>
                  )}
                />
                <RangeControl
                  label={__("Border Radius (PX)")}
                  value={iconRadius}
                  onChange={newValue => setAttributes({ iconRadius: newValue })}
                />
              </Fragment>
            )}
            <SelectControl
              label={__("Hover Effect")}
              options={EFFECTS}
              value={hoverEffect}
              onChange={newEffect => setAttributes({ hoverEffect: newEffect })}
            />
            <RangeControl
              label={__("Size (PX)")}
              value={iconSize}
              min="1"
              max="200"
              onChange={newValue => setAttributes({ iconSize: newValue })}
            />
          </PanelBody>
        )}
        {titleChecked && (
          <PanelBody
            title={__("Title")}
            className="premium-panel-body"
            initialOpen={false}
          >
            <PanelBody
              title={__("Font")}
              className="premium-panel-body premium-panel-body-inner"
              initialOpen={false}
            >
              <p>{__("Title")}</p>
              <Toolbar
                controls={"123456".split("").map(tag => ({
                  icon: "heading",
                  isActive: "H" + tag === titleTag,
                  onClick: () => setAttributes({ titleTag: "H" + tag }),
                  subscript: tag
                }))}
              />
              <PremiumTypo
                components={[
                  "size",
                  "weight",
                  "style",
                  "upper",
                  "spacing",
                  "line"
                ]}
                size={titleSize}
                weight={titleWeight}
                style={titleStyle}
                spacing={titleLetter}
                line={titleLine}
                upper={titleUpper}
                onChangeSize={newSize => setAttributes({ titleSize: newSize })}
                onChangeWeight={newWeight =>
                  setAttributes({ titleWeight: newWeight })
                }
                onChangeStyle={newStyle =>
                  setAttributes({ titleStyle: newStyle })
                }
                onChangeSpacing={newValue =>
                  setAttributes({ titleLetter: newValue })
                }
                onChangeLine={newValue =>
                  setAttributes({ titleLine: newValue })
                }
                onChangeUpper={check => setAttributes({ titleUpper: check })}
              />
            </PanelBody>
            <PanelColorSettings
              title={__("Colors")}
              className="premium-panel-body-inner"
              initialOpen={false}
              colorSettings={[
                {
                  value: titleColor,
                  onChange: newColor => setAttributes({ titleColor: newColor }),
                  label: __("Text Color")
                }
              ]}
            />
            <PremiumTextShadow
              color={titleShadowColor}
              blur={titleShadowBlur}
              horizontal={titleShadowHorizontal}
              vertical={titleShadowVertical}
              onChangeColor={newColor =>
                setAttributes({ titleShadowColor: newColor })
              }
              onChangeBlur={newBlur =>
                setAttributes({ titleShadowBlur: newBlur })
              }
              onChangehHorizontal={newValue =>
                setAttributes({ titleShadowHorizontal: newValue })
              }
              onChangeVertical={newValue =>
                setAttributes({ titleShadowVertical: newValue })
              }
            />
            <PanelBody
              title={__("Spacings")}
              className="premium-panel-body-inner"
              initialOpen={false}
            >
              <PremiumMargin
                directions={["top", "bottom"]}
                marginTop={titleMarginT}
                marginBottom={titleMarginB}
                onChangeMarTop={value =>
                  setAttributes({
                    titleMarginT: value === undefined ? 0 : value
                  })
                }
                onChangeMarBottom={value =>
                  setAttributes({
                    titleMarginB: value === undefined ? 0 : value
                  })
                }
              />
            </PanelBody>
          </PanelBody>
        )}
        {descChecked && (
          <PanelBody
            title={__("Description")}
            className="premium-panel-body"
            initialOpen={false}
          >
            <PanelBody
              title={__("Font")}
              className="premium-panel-body-inner"
              initialOpen={false}
            >
              <PremiumTypo
                components={["size", "weight", "line"]}
                size={descSize}
                weight={descWeight}
                line={descLine}
                onChangeSize={newSize => setAttributes({ descSize: newSize })}
                onChangeWeight={newWeight =>
                  setAttributes({ descWeight: newWeight })
                }
                onChangeLine={newValue => setAttributes({ descLine: newValue })}
              />
            </PanelBody>
            <PanelColorSettings
              title={__("Colors")}
              className="premium-panel-body-inner"
              initialOpen={false}
              colorSettings={[
                {
                  value: descColor,
                  onChange: newColor => setAttributes({ descColor: newColor }),
                  label: __("Text Color")
                }
              ]}
            />
            <PanelBody
              title={__("Spacings")}
              className="premium-panel-body-inner"
              initialOpen={false}
            >
              <PremiumMargin
                directions={["top", "bottom"]}
                marginTop={descMarginT}
                marginBottom={descMarginB}
                onChangeMarTop={value =>
                  setAttributes({
                    descMarginT: value === undefined ? 0 : value
                  })
                }
                onChangeMarBottom={value =>
                  setAttributes({
                    descMarginB: value === undefined ? 0 : value
                  })
                }
              />
            </PanelBody>
          </PanelBody>
        )}

        {btnChecked && (
          <PanelBody
            title={__("Button")}
            className="premium-panel-body"
            initialOpen={false}
          >
            <SelectControl
              options={BTN_EFFECTS}
              label={__("Hover Effect")}
              value={btnEffect}
              onChange={newValue => setAttributes({ btnEffect: newValue })}
            />
            {"slide" === btnEffect && (
              <SelectControl
                options={DIRECTION}
                label={__("Direction")}
                value={effectDir}
                onChange={newValue => setAttributes({ effectDir: newValue })}
              />
            )}
            <ToggleControl
              label={__("Open link in new tab")}
              checked={btnTarget}
              onChange={newValue => setAttributes({ btnTarget: newValue })}
            />
            <PanelBody
              title={__("Font")}
              className="premium-panel-body-inner"
              initialOpen={false}
            >
              <PremiumTypo
                components={["size", "weight", "style", "upper", "spacing"]}
                size={btnSize}
                weight={btnWeight}
                style={btnStyle}
                spacing={btnLetter}
                upper={btnUpper}
                onChangeSize={newSize => setAttributes({ btnSize: newSize })}
                onChangeWeight={newWeight =>
                  setAttributes({ btnWeight: newWeight })
                }
                onChangeStyle={newStyle =>
                  setAttributes({ btnStyle: newStyle })
                }
                onChangeSpacing={newValue =>
                  setAttributes({ btnLetter: newValue })
                }
                onChangeUpper={check => setAttributes({ btnUpper: check })}
              />
            </PanelBody>
            <PanelColorSettings
              title={__("Colors")}
              className="premium-panel-body-inner"
              initialOpen={false}
              colorSettings={[
                {
                  value: btnColor,
                  onChange: newColor => setAttributes({ btnColor: newColor }),
                  label: __("Text Color")
                },
                {
                  value: btnHoverColor,
                  onChange: newColor =>
                    setAttributes({ btnHoverColor: newColor }),
                  label: __("Text Hover Color")
                },
                {
                  value: btnBack,
                  onChange: newColor => setAttributes({ btnBack: newColor }),
                  label: __("Background Color")
                },
                {
                  value: btnHoverBack,
                  onChange: newColor =>
                    setAttributes({ btnHoverBack: newColor }),
                  label: __("Background Hover Color")
                },
                {
                  value: btnHoverBorder,
                  onChange: newColor =>
                    setAttributes({ btnHoverBorder: newColor }),
                  label: __("Border Hover Color")
                }
              ]}
            />
            <PanelBody
              title={__("Border")}
              className="premium-panel-body-inner"
              initialOpen={false}
            >
              <PremiumBorder
                borderType={btnBorderType}
                borderWidth={btnBorderWidth}
                borderColor={btnBorderColor}
                borderRadius={btnBorderRadius}
                onChangeType={newType =>
                  setAttributes({ btnBorderType: newType })
                }
                onChangeWidth={newWidth =>
                  setAttributes({ btnBorderWidth: newWidth })
                }
                onChangeColor={colorValue =>
                  setAttributes({ btnBorderColor: colorValue })
                }
                onChangeRadius={newrRadius =>
                  setAttributes({ btnBorderRadius: newrRadius })
                }
              />
            </PanelBody>
            <PremiumBoxShadow
              inner={true}
              color={btnShadowColor}
              blur={btnShadowBlur}
              horizontal={btnShadowHorizontal}
              vertical={btnShadowVertical}
              position={btnShadowPosition}
              onChangeColor={newColor =>
                setAttributes({
                  btnShadowColor:
                    newColor === undefined ? "transparent" : newColor
                })
              }
              onChangeBlur={newBlur =>
                setAttributes({
                  btnShadowBlur: newBlur === undefined ? 0 : newBlur
                })
              }
              onChangehHorizontal={newValue =>
                setAttributes({
                  btnShadowHorizontal: newValue === undefined ? 0 : newValue
                })
              }
              onChangeVertical={newValue =>
                setAttributes({
                  btnShadowVertical: newValue === undefined ? 0 : newValue
                })
              }
              onChangePosition={newValue =>
                setAttributes({
                  btnShadowPosition: newValue === undefined ? 0 : newValue
                })
              }
            />
            <PanelBody
              title={__("Spacings")}
              className="premium-panel-body-inner"
              initialOpen={false}
            >
              <RangeControl
                label={__("Padding (PX)")}
                value={btnPadding}
                onChange={newValue => setAttributes({ btnPadding: newValue })}
              />
              <PremiumMargin
                directions={["top", "bottom"]}
                marginTop={btnMarginT}
                marginBottom={btnMarginB}
                onChangeMarTop={value =>
                  setAttributes({
                    btnMarginT: value === undefined ? 0 : value
                  })
                }
                onChangeMarBottom={value =>
                  setAttributes({
                    btnMarginB: value === undefined ? 0 : value
                  })
                }
              />
            </PanelBody>
          </PanelBody>
        )}

        <PanelBody
          title={__("Container")}
          className="premium-panel-body"
          initialOpen={false}
        >
          <p>{__("Align")}</p>
          <Toolbar
            controls={ALIGNS.map(contentAlign => ({
              icon: "editor-align" + contentAlign,
              isActive: contentAlign === align,
              onClick: () => setAttributes({ align: contentAlign })
            }))}
          />
          <PanelBody
            title={__("Background")}
            className="premium-panel-body-inner"
            initialOpen={false}
          >
            <PanelColorSettings
              title={__("Colors")}
              className="premium-panel-body-inner"
              initialOpen={false}
              colorSettings={[
                {
                  value: backColor,
                  onChange: colorValue =>
                    setAttributes({ backColor: colorValue }),
                  label: __("Background Color")
                }
              ]}
            />
            {imageURL && <img src={imageURL} width="100%" height="auto" />}
            <PremiumBackgroud
              imageID={imageID}
              imageURL={imageURL}
              backgroundPosition={backgroundPosition}
              backgroundRepeat={backgroundRepeat}
              backgroundSize={backgroundSize}
              fixed={fixed}
              onSelectMedia={media => {
                setAttributes({
                  imageID: media.id,
                  imageURL: media.url
                });
              }}
              onRemoveImage={value =>
                setAttributes({ imageURL: "", imageID: "" })
              }
              onChangeBackPos={newValue =>
                setAttributes({ backgroundPosition: newValue })
              }
              onchangeBackRepeat={newValue =>
                setAttributes({ backgroundRepeat: newValue })
              }
              onChangeBackSize={newValue =>
                setAttributes({ backgroundSize: newValue })
              }
              onChangeFixed={check => setAttributes({ fixed: check })}
            />
          </PanelBody>
          <PanelBody
            title={__("Border")}
            className="premium-panel-body-inner"
            initialOpen={false}
          >
            <PremiumBorder
              borderType={borderType}
              borderWidth={borderWidth}
              borderColor={borderColor}
              borderRadius={borderRadius}
              onChangeType={newType => setAttributes({ borderType: newType })}
              onChangeWidth={newWidth =>
                setAttributes({ borderWidth: newWidth })
              }
              onChangeColor={colorValue =>
                setAttributes({ borderColor: colorValue })
              }
              onChangeRadius={newrRadius =>
                setAttributes({ borderRadius: newrRadius })
              }
            />
          </PanelBody>
          <PremiumBoxShadow
            inner={true}
            color={shadowColor}
            blur={shadowBlur}
            horizontal={shadowHorizontal}
            vertical={shadowVertical}
            position={shadowPosition}
            onChangeColor={newColor =>
              setAttributes({
                shadowColor: newColor === undefined ? "transparent" : newColor
              })
            }
            onChangeBlur={newBlur =>
              setAttributes({
                shadowBlur: newBlur === undefined ? 0 : newBlur
              })
            }
            onChangehHorizontal={newValue =>
              setAttributes({
                shadowHorizontal: newValue === undefined ? 0 : newValue
              })
            }
            onChangeVertical={newValue =>
              setAttributes({
                shadowVertical: newValue === undefined ? 0 : newValue
              })
            }
            onChangePosition={newValue =>
              setAttributes({
                shadowPosition: newValue === undefined ? 0 : newValue
              })
            }
          />
          <PanelBody
            title={__("Spacings")}
            className="premium-panel-body-inner"
            initialOpen={false}
          >
            <PremiumMargin
              directions={["all"]}
              marginTop={marginT}
              marginRight={marginR}
              marginBottom={marginB}
              marginLeft={marginL}
              onChangeMarTop={value =>
                setAttributes({
                  marginT: value === undefined ? 0 : value
                })
              }
              onChangeMarRight={value =>
                setAttributes({
                  marginR: value === undefined ? 0 : value
                })
              }
              onChangeMarBottom={value =>
                setAttributes({
                  marginB: value === undefined ? 0 : value
                })
              }
              onChangeMarLeft={value =>
                setAttributes({
                  marginL: value === undefined ? 0 : value
                })
              }
            />
            <PremiumPadding
              paddingTop={paddingT}
              paddingRight={paddingR}
              paddingBottom={paddingB}
              paddingLeft={paddingL}
              onChangePadTop={value =>
                setAttributes({
                  paddingT: value === undefined ? 0 : value
                })
              }
              onChangePadRight={value =>
                setAttributes({
                  paddingR: value === undefined ? 0 : value
                })
              }
              onChangePadBottom={value =>
                setAttributes({
                  paddingB: value === undefined ? 0 : value
                })
              }
              onChangePadLeft={value =>
                setAttributes({
                  paddingL: value === undefined ? 0 : value
                })
              }
            />
          </PanelBody>
        </PanelBody>
      </InspectorControls>
    ),
    <div
      id={`${className}-${id}`}
      className={`${className}`}
      style={{
        textAlign: align,
        border: borderType,
        borderWidth: borderWidth + "px",
        borderRadius: borderRadius + "px",
        borderColor: borderColor,
        marginTop: marginT,
        marginRight: marginR,
        marginBottom: marginB,
        marginLeft: marginL,
        paddingTop: paddingT,
        paddingRight: paddingR,
        paddingBottom: paddingB,
        paddingLeft: paddingL,
        boxShadow: `${shadowHorizontal}px ${shadowVertical}px ${shadowBlur}px ${shadowColor} ${shadowPosition}`,
        backgroundColor: backColor,
        backgroundImage: `url('${imageURL}')`,
        backgroundRepeat: backgroundRepeat,
        backgroundPosition: backgroundPosition,
        backgroundSize: backgroundSize,
        backgroundAttachment: fixed ? "fixed" : "unset"
      }}
    >
      {btnChecked && btnText && (
        <style
          dangerouslySetInnerHTML={{
            __html: [
              `#premium-icon-box-${id} .premium-icon-box__btn:hover {`,
              `color: ${btnHoverColor} !important;`,
              `border-color: ${btnHoverBorder} !important;`,
              "}",
              `#premium-icon-box-${id} .premium-button__none .premium-icon-box__btn:hover {`,
              `background-color: ${btnHoverBack} !important;`,
              "}",
              `#premium-icon-box-${id} .premium-button__slide .premium-button::before {`,
              `background-color: ${btnHoverBack} !important;`,
              "}"
            ].join("\n")
          }}
        />
      )}
      {iconChecked && (
        <div className={`${className}__icon_wrap`}>
          {"icon" === iconImage && (
            <Fragment>
              {iconType === "fa" && 1 != FontAwesomeEnabled && (
                <p className={`${className}__alert`}>
                  {__("Please Enable Font Awesome Icons from Plugin settings")}
                </p>
              )}
              {(iconType === "dash" || 1 == FontAwesomeEnabled) && (
                <i
                  className={`${selectedIcon} ${className}__icon premium-icon__${hoverEffect}`}
                  style={{
                    color: iconColor,
                    fontSize: iconSize
                  }}
                />
              )}
            </Fragment>
          )}
          {"image" === iconImage && iconImgUrl && (
            <img
              className={`${className}__icon premium-icon__${hoverEffect}`}
              src={`${iconImgUrl}`}
              alt="Image Icon"
              style={{
                width: iconSize + "px",
                height: iconSize + "px",
                borderRadius: iconRadius + "px"
              }}
            />
          )}
        </div>
      )}
      {titleChecked && titleText && (
        <div
          className={`${className}__title_wrap`}
          style={{
            marginTop: titleMarginT,
            marginBottom: titleMarginB
          }}
        >
          <RichText
            tagName={titleTag.toLowerCase()}
            className={`${className}__title`}
            onChange={newText => setAttributes({ titleText: newText })}
            placeholder={__("Awesome Title")}
            value={titleText}
            style={{
              color: titleColor,
              fontSize: titleSize + "px",
              letterSpacing: titleLetter + "px",
              textTransform: titleUpper ? "uppercase" : "none",
              fontStyle: titleStyle,
              fontWeight: titleWeight,
              textShadow: `${titleShadowHorizontal}px ${titleShadowVertical}px ${titleShadowBlur}px ${titleShadowColor}`,
              lineHeight: titleLine + "px"
            }}
            keepPlaceholderOnFocus
          />
        </div>
      )}
      {descChecked && descText && (
        <div
          className={`${className}__desc_wrap`}
          style={{
            marginTop: descMarginT,
            marginBottom: descMarginB
          }}
        >
          <RichText
            tagName="p"
            className={`${className}__desc`}
            value={descText}
            isSelected={false}
            placeholder="Donec id elit non mi porta gravida at eget metus. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Cras mattis consectetur purus sit amet fermentum. Nullam id dolor id nibh ultricies vehicula ut id elit. Donec id elit non mi porta gravida at eget metus."
            onChange={newText => setAttributes({ descText: newText })}
            style={{
              color: descColor,
              fontSize: descSize + "px",
              lineHeight: descLine + "px",
              fontWeight: descWeight
            }}
            keepPlaceholderOnFocus
          />
        </div>
      )}
      {btnChecked && btnText && (
        <div
          className={`${className}__btn_wrap premium-button__${btnEffect} premium-button__${effectDir}`}
          style={{
            marginTop: btnMarginT,
            marginBottom: btnMarginB
          }}
        >
          <RichText
            tagName="a"
            className={`${className}__btn premium-button`}
            onChange={newText => setAttributes({ btnText: newText })}
            placeholder={__("Click Here")}
            value={btnText}
            style={{
              color: btnColor,
              backgroundColor: btnBack,
              fontSize: btnSize + "px",
              letterSpacing: btnLetter + "px",
              textTransform: btnUpper ? "uppercase" : "none",
              fontStyle: btnStyle,
              fontWeight: btnWeight,
              border: btnBorderType,
              borderWidth: btnBorderWidth + "px",
              borderRadius: btnBorderRadius + "px",
              borderColor: btnBorderColor,
              padding: btnPadding + "px",
              boxShadow: `${btnShadowHorizontal}px ${btnShadowVertical}px ${btnShadowBlur}px ${btnShadowColor} ${btnShadowPosition}`
            }}
            keepPlaceholderOnFocus
          />
          {isSelected && (
            <URLInput
              value={btnLink}
              onChange={newLink => setAttributes({ btnLink: newLink })}
            />
          )}
        </div>
      )}
    </div>
  ];
};

export default edit;
