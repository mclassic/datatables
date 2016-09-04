# Datatables Server-Side Processor
**ALPHA TESTING - DO NOT USE IN PRODUCTION**

This app *will* break until alpha is complete. Basically, unless you are contributing to the project for an official 0.x.x release, you shouldn't be running this in production.

Copyright (c) Mike Classic

- Website: [mikeclassic.ca](http://www.mikeclassic.ca)
- Twitter: [@BigMikeClassic](https://www.twitter.com/BigMikeClassic)
- Github: [mclassic](https://www.github.com/mclassic)

# MIT License
This software uses the MIT open source license. Please review the LICENSE.md file for more information.

- [Overview](#overview)
- [Installation](#installation)

<a name="overview"></a>
# Overview
This library acts as a server-side processor for the [Datatables](http://www.datatables.net) plugin, written for
[jQuery.](http://www.jquery.com)

The plugin made for the jQuery JS library is a configurable table renderer for the front-end. This library is meant for
interacting with data on the server side that may be requested from the front-end plugin.

Datatables processes and manipulates data in one of two ways: client side and server side.

## Communication Protocols
Both versions of the Datatables communication protocol are supported.
- [Legacy](http://legacy.datatables.net/usage/server-side) (version 1.9 and lower)
- [Modern/Current](http://www.datatables.net) (version 1.10 and higher)

## Features
Features in this library:

- Supports and auto-detects both Datables protocols
- Able to process, filter, order, paginate data on [server side](https://datatables.net/reference/option/serverSide)

### Server-Side Processing

The strength of this library lies in its ability to perform server side pagination, filtering, ordering,
and other result set manipulation.

This is a big advantage when large data sets are involved. Problems arise with the use of large data sets and the way
that the Datatables jQuery plugin handles them when client-side processing.

<a name="installation"></a>
## Installation
This library uses [Composer](http://www.getcomposer.org) as its package manager.

Add this library to your composer.json in one of two ways.

composer.json
```json
"require": {
  "mclassic/datatables": "dev-master"
}
```
