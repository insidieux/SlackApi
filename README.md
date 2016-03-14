# SlackApi

[![Build Status](https://travis-ci.org/insidieux/SlackApi.svg?branch=master)](https://travis-ci.org/insidieux/SlackApi)
[![Code Climate](https://codeclimate.com/github/insidieux/SlackApi/badges/gpa.svg)](https://codeclimate.com/github/insidieux/SlackApi)
[![Test Coverage](https://codeclimate.com/github/insidieux/SlackApi/badges/coverage.svg)](https://codeclimate.com/github/insidieux/SlackApi/coverage)

A simple PHP package for making request to [Slack API](https://api.slack.com/methods), focused on ease-of-use and elegant syntax.

## Requirements

* PHP 5.6 or greater
* GuzzleHttp 6.0 or greater

## Installation

You can install the package using the [Composer](https://getcomposer.org/) package manager. You can install it by running this command in your project root:

```sh
composer require insidieux/SlackApi
```

Then just use this simple code

```php
$httpClient = new \GuzzleHttp\Client;
$slackClient = new \SlackApi\Client('your-token-here', $httpClient);
$slackClient->request('POST', 'module.method', ['argument' => 'value']);
```

Author
-------

- [Ageev Pavel](mailto:ageev.pavel.v@gmail.com)
