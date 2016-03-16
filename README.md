# SlackApi

[![Build Status](https://travis-ci.org/insidieux/SlackApi.svg?branch=master)](https://travis-ci.org/insidieux/SlackApi)
[![Code Climate](https://codeclimate.com/github/insidieux/SlackApi/badges/gpa.svg)](https://codeclimate.com/github/insidieux/SlackApi)
[![Codacy Badge](https://api.codacy.com/project/badge/grade/b00ef4c01ef24daaaf57f99c345ad546)](https://www.codacy.com/app/ageev-pavel-v/SlackApi)
[![Codacy Badge](https://api.codacy.com/project/badge/coverage/b00ef4c01ef24daaaf57f99c345ad546)](https://www.codacy.com/app/insidieux/SlackApi)

A simple PHP package for making request to [Slack API](https://api.slack.com/methods), focused on ease-of-use and elegant syntax.

## Requirements

* PHP 5.5 or greater
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
