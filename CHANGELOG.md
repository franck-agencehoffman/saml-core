Changelog
=========
# 3.2.4 2021-03-12
## Fixed
- Updating control panel lists to be explicit.

# 3.2.3 2021-02-12
## Fixed
- Migration issue with duplicate metadataOptions

# 3.2.2 2021-02-11
## Fixed
- Migration error when upgrading to Craft CMS 3.6. ref: https://github.com/flipboxfactory/saml-idp/issues/22 and https://github.com/flipboxfactory/saml-sp/issues/98

# 3.2.1 2021-01-28
## Fixed
- Issue with missing beginning forward slash on the provider url when it's not a full url

# 3.2.0 2021-01-09
## Added
- EntityID is is now editible
- Site Selection on My provider page

## Changed
- Url formating
- `flipbox\saml\core\services\Metadata::create` (moved to providers records)


# 3.1.2 - 2020-10-29
## Fixed
- Issue where SP and IdP plugin couldn't be installed on the same craft db due to table conflicts.

# 3.1.0 - 2020-09-22
## Added
- Added NameID Override per IDP to the SP templates.

# 3.0.1 - 2020-08-06
## Fixed
- Constraint on the provider identity table.

# 3.0.0 - 2020-07-14
## Changed
- Updated `simplesamlphp/saml2` to `^4.1`.

# 2.1.7 - 2020-05-15
## Removed
- `\flipbox\saml\core\helpers\SerializeHelper::toBase64`
- `\flipbox\saml\core\helpers\SerializeHelper::isBase64String`

# 2.1.6 - 2020-05-06
## Fixed
- Missed a spot with 57 https://github.com/flipboxfactory/saml-sp/issues/57

# 2.1.5 - 2020-05-05
## Fixed
- Issue CP panel presenting the SLO endpoint, fixing: https://github.com/flipboxfactory/saml-sp/issues/57

# 2.1.4 - 2020-03-12
## Fixed
- Fixed issue with Metadata URL not overwriting the metadata correctly via the control panel.

# 2.1.3 - 2020-03-04
## Fixed
- Fixes issue with `GeneralConfig::headlessMode` by explicitly setting response to HTML. Fixes: https://github.com/flipboxfactory/saml-sp/issues/53

# 2.1.2 - 2020-02-06
## Fixed
- Fixing issue with migration from 1.x to 2.x. Fixes: https://github.com/flipboxfactory/saml-sp/issues/51

# 2.1.1.1 - 2020-01-08
## Fixed
- Fixing issue with Craft 3.2 twig error within the editableTable

# 2.1.1 - 2020-01-08
## Fixed
- Fixing issue with postgres uid - https://github.com/flipboxfactory/saml-sp/issues/49

# 2.1.0 - 2020-01-07
## Fixed
- Fixing issue with requiring admin when project config when `allowAdminChanges` general config is set.
- Duplicate `metadata` html attribute id on the edit page
- Fixed issue with large Metadata too big for the db metadata column (requires migration) https://github.com/flipboxfactory/saml-sp/issues/48

## Added
- Support for Saving Metadata via url (requires migration) https://github.com/flipboxfactory/saml-sp/issues/47

# 2.0.26 - 2020-01-03
## Fixed
- Issue with OneLogin signiture verification.

# 2.0.25 - 2019-11-07
## Fixed
- Patching issue with more than one signing key, filters signing key, and improved bail when signiture is verified

# 2.0.24 - 2019-11-07
## Fixed
- Issue with verifying signitures for providers with more than one signing key

# 2.0.23 - 2019-10-15
## Fixed
- Fixed url in admin for SPs request login and logout

# 2.0.20 - 2019-10-07
## Removed
- flipboxfactory/craft-ember package to easy updates with dependancies.

# 2.0.18 - 2019-10-02
## Added
- Added config option `sloDestroySpecifiedSessions` to support SLO for specified users

# 2.0.17 - 2019-10-01
## Fixed
- Issue with HTTP-Redirect

## Added
- Support for HTTP-Redirect binding for SLO

# 2.0.16 - 2019-09-26
## Fixed
- Issue with decrypting assertions
- Link not rendering correctly on the edit screen for providers

# 2.0.15 - 2019-09-25
## Fixed
- Fixing more xsd schema compatibility. Changed message ids to be compatible.
- Fixed exception when the user tries to logout (SLO) when they are already logged out.

# 2.0.11 - 2019-09-25
## Fixed
- Fixed xsd schema compatibility. Changed Indexed Endpoints to normal Endpoints (removing invalid index attribute).

# 2.0.5
## Fixed
- Fixed issue with cp links on the list page 

# 2.0.3.7
## Changed
- Changing AccessDenied Exception to a yii HttpException which returns a 403 status

# 2.0.0
## Changed
- Lots of changes!
- Switched from the php LightSaml package to the simplesamlphp core lib.
- Code clean up and considation

# 1.0.1
## Fixed
- Refactoring for cleanup

# 1.0.0-RC1
## Added
- Improved Control Panel UI
- Login via admin for sp
- Labels for Providers
- Auto generate OpenSSL key pairs with Keychain
- Mapping attributes based on provider

# 1.0.0-beta.12
## Fixed
- defaulting signing method to rsa256 (instead of sha1)

# 1.0.0-beta.11
## Fixed
- Fixed a bug where during the verification of a signature, we were pulling the first key from the metadata
which could be the wrong one. Now specify the signing key.

# 1.0.0-beta.10
## Fixed
- Fixed issue with base64 being encoded twice.
## Added
- Easy logging for the plugin

# 1.0.0-beta.9
## Fixed
- Issue with saving metadata with signatures on them

## Removed
- Restriction on forcing HTTP POST for SLO request

# 1.0.0-beta.8
Initial release.
