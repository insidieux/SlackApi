# SlackApi

[![Build Status](https://travis-ci.org/insidieux/SlackApi.svg?branch=master)](https://travis-ci.org/insidieux/SlackApi)
[![Code Climate](https://codeclimate.com/github/insidieux/SlackApi/badges/gpa.svg)](https://codeclimate.com/github/insidieux/SlackApi)
[![Codacy Badge](https://api.codacy.com/project/badge/grade/b00ef4c01ef24daaaf57f99c345ad546)](https://www.codacy.com/app/ageev-pavel-v/SlackApi)
[![Test Coverage](https://codeclimate.com/github/insidieux/SlackApi/badges/coverage.svg)](https://codeclimate.com/github/insidieux/SlackApi/coverage)

A simple PHP package for making request to [Slack API](https://api.slack.com/methods), focused on ease-of-use and elegant syntax.

## Requirements

* PHP 5.5 or greater
* GuzzleHttp 6.0 or greater

## Installation

You can install the package using the [Composer](https://getcomposer.org/) package manager. You can install it by running this command in your project root:

```sh
composer require insidieux/SlackApi
```

## Usage

Simple way to use library 

```php
$client = new \SlackApi\Client('your-token-here', new \GuzzleHttp\Client);
$response = $client->request('POST', 'module.method', ['argument' => 'value']);
$response->toArray();
```

Or you can use predefined modules and methods

```php
$client = new \SlackApi\Client('your-token-here', new GuzzleHttp\Client);
$response = $client->users()->getList();
$response->toArray()
```

Predefined modules:
* [channels] (https://api.slack.com/methods#channels)
* [chat] (https://api.slack.com/methods#chat)
* [dnd] (https://api.slack.com/methods#dnd)
* [emoji] (https://api.slack.com/methods#emoji)
* [files] (https://api.slack.com/methods#files)
* [groups] (https://api.slack.com/methods#groups)
* [im] (https://api.slack.com/methods#im)
* [oauth] (https://api.slack.com/methods#oauth)
* [pins] (https://api.slack.com/methods#pins)
* [search] (https://api.slack.com/methods#search)
* [team] (https://api.slack.com/methods#team)
* [usergroups] (https://api.slack.com/methods#usergroups)
* [users] (https://api.slack.com/methods#users)

Author
-------

- [Ageev Pavel](mailto:ageev.pavel.v@gmail.com)
