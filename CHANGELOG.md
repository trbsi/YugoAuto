# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.20.0] - 2023-04-21

### Changed

- Simplify rating logic

## [1.19.0] - 2023-04-19

### Added

- Rate user if user cancelled to late

## [1.18.4] - 2023-04-20

### Added

- Add redirect url to the app store

## [1.18.3] - 2023-04-19

### Added

- Added Serbian cities
    - Thanks to https://simplemaps.com/data/rs-cities
- Added BiH cities
    - Thanks to https://simplemaps.com/data/ba-cities
- Added Slovenian cities
    - Thanks to https://simplemaps.com/data/si-cities
- Added Montenegro cities
    - Thanks to https://simplemaps.com/data/me-cities

## [1.18.2] - 2023-04-19

### Changed

- Moved delete user to logic class

### Added

- Command for deleting user manually

## [1.18.1] - 2023-04-18

### Added

- Show modal only to loggedin user

## [1.18.0] - 2023-04-18

### Added

- Verify phone number via Firebase...
    - Thanks ChatGPT and https://firebase.google.com/docs/auth/web/phone-auth?hl=en&authuser=0#web-version-9_5 for help

## [1.17.0] - 2023-04-16

### Added

- Added driver profile
- Add phone number field

## [1.16.2] - 2023-04-17

### Fixed

- Fix image orientation

## [1.16.1] - 2023-04-17

### Changed

- Changed image picker to be regular input(file) so image picker can work on Android via webview
    - Fixed in mobile app in version 1.1.0

## [1.16.0] - 2023-04-16

### Added

- Austrian cities. Data taken from Chat GPT.

## [1.15.3] - 2023-04-16

### Added

- When user is reported, include user id so we know who is reported.

## [1.15.2] - 2023-04-15

### Fixed

- Change rating stars size

## [1.15.1] - 2023-04-15

### Fixed

- Make non-active rides transparent so people can actually notice that those are old an inactive rides

## [1.15.0] - 2023-04-13

### Fixed

- Validate email even if not loggedin. Because when user registers in app, clicks on link in email and it takes him in
  browser where user is not loggedin. Then we want to verify email even if user is not loggedin.
    - Thanks
      to https://stackoverflow.com/questions/64172138/laravel-8-how-do-i-verify-the-users-email-address-after-registration-without-ha

## [1.14.4] - 2023-04-14

### Fixed

- Use PHP constants to set date and time format

## [1.14.3] - 2023-04-14

### Fixed

- Fix datetime picker, remove seconds from time picker in "create ride"

## [1.14.2] - 2023-04-13

### Fixed

- In time picker add 15 minutes step

## [1.14.1] - 2023-04-12

### Fixed

- Fix when user is deleted. Delete conversations also otherwise messaging won't work because of foreign key

## [1.14.0] - 2023-04-12

### Changed

- Improved error handling and error pages (404 and 500). Add nicer design and possibility for user to go back

## [1.13.2] - 2023-04-12

### Changed

- Improve user data deletion. Delete user rides and messages.

## [1.13.1] - 2023-04-11

### Fixed

- Minor fix when passenger can see "Requests" link in "My Rides"
    - Only when ride is active

## [1.13.0] - 2023-04-11

### Added

- Display user ratings on the profile

## [1.12.0] - 2023-04-11

### Fixed

- Fixed rating logic

## [1.11.2] - 2023-04-11

### Changed

- Push notification message when ride is cancelled

## [1.11.1] - 2023-04-10

### Changed

- Enable modal for App Store and Google Play

## [1.11.0] - 2023-04-09

### Added

- Add possibility to open and redirect to another route because sometimes we want to open yugoauto.com from mobile app
  in mobile browser.
    - This is because on Android we cannot choose profile pic from Webview, thus people need to use browser to do that

## [1.10.0] - 2023-04-09

### Added

- Big cities from Balkan countries
- Country id to places table

## [1.9.1] - 2023-04-09

### Added

- Back button in header so it is easier to navigate on phone

### Fixed

- Make week start with Monday

## [1.9.0] - 2023-04-09

### Added

- SweetAlert because alert() does not work on iOS

## [1.8.0] - 2023-04-09

### Added

- Modal support

## [1.7.0] - 2023-04-08

### Added

- Android and iPhone store URLs

## [1.6.1] - 2023-04-08

### Removed

- Turn off Google Analytics

### Added

- Accurate cookie consent

## [1.6.1] - 2023-04-07

### Fixed

- Dark mode design

## [1.6.0] - 2023-04-07

### Added

- Dark/Light mode switcher

### Fixed

- Filter input in dark mode

## [1.5.0] - 2023-04-05

### Added

- Show alert on page if user has pending requests for the ride

## [1.4.0] - 2023-04-05

### Changed

- Refactor email communication to accept value object
- Update en.json translation

## [1.3.0] - 2023-04-05

### Added

- Report user option

## [1.2.2] - 2023-04-05

### Fixed

- Profile picture size

## [1.2.1] - 2023-04-04

### Added

- Number of ratings on user profile

## [1.2.0] - 2023-04-04

### Added

- Command for restarting supervisor
- Database queue (queue emails and push notifications)
- Push notifications feature for mobile
- Nl2br and strip tags to ride description

## [1.1.1] - 2023-04-03

### Added

- Database queue

## [1.1.0] - 2023-04-03

### Added

- Push notifications support

## [1.0.11] - 2023-01-10

### Added

- Add Facebook share og-tags

## [1.0.10] - 2023-01-10

### Added

- Add index to places table

## [1.0.9] - 2023-03-31

### Added

- Filter by date range

## [1.0.8] - 2023-03-31

### Added

- Add possibility to switch city places

## [1.0.7] - 2023-03-31

### Added

- In search, on focus clear inputs so dates can be cleared

## [1.0.6] - 2023-03-31

### Removed

- Remove time picker from search

### Added

- Allow filtering without time

## [1.0.5] - 2023-03-30

### Added

- Possibility for passenger to see accepted requests from ride he is a part of

## [1.0.4] - 2023-03-30

### Added

- Allow driver and passenger to cancel ride

## [1.0.3] - 2023-03-30

### Added

- Throttle contact route

## [1.0.2] - 2023-03-30

### Added

- List newest rides on front page as default
- Add restriction for ride request if ride is filled

## [1.0.1] - 2023-03-29

### Added

- Language switcher

## [1.0.0] - 2023-03-26

### Added

- MVP
