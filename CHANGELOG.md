# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

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
