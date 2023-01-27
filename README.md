# SlackApi

| This project is very outdated and behind the current actual version of php, as well as the current version of the Slack API. We strongly DO NOT RECOMMEND you to use this library and we advise you to switch to one of the published packages from the official Slack documentation - https://api.slack.com/community#php |
|-----------------------------------------|


[![Build Status](https://travis-ci.org/insidieux/SlackApi.svg?branch=master)](https://travis-ci.org/insidieux/SlackApi)
[![Code Climate](https://codeclimate.com/github/insidieux/SlackApi/badges/gpa.svg)](https://codeclimate.com/github/insidieux/SlackApi)
[![Test Coverage](https://codeclimate.com/github/insidieux/SlackApi/badges/coverage.svg)](https://codeclimate.com/github/insidieux/SlackApi/coverage)
[![Codacy Badge](https://api.codacy.com/project/badge/grade/b00ef4c01ef24daaaf57f99c345ad546)](https://www.codacy.com/app/ageev-pavel-v/SlackApi)
[![Codacy Badge](https://api.codacy.com/project/badge/coverage/b00ef4c01ef24daaaf57f99c345ad546)](https://www.codacy.com/app/insidieux/SlackApi)

A simple PHP package for making request to [Slack API](https://api.slack.com/methods), focused on ease-of-use and elegant syntax.

## Requirements

* PHP 5.5 or greater
* [CURL extension for PHP](http://php.net/manual/ru/book.curl.php)

## Installation

You can install the package using the [Composer](https://getcomposer.org/) package manager. You can install it by running this command in your project root:

```sh
composer require insidieux/slack-api
```

## Usage

Create API client 

```php
$client = new \SlackApi\Client('your-token-here');
```

Make request 
```php
$client = new \SlackApi\Client('your-token-here');
$response = $client->request('module.method', ['argument' => 'value']);
$response->toArray();
```

Or you can use predefined modules and methods

```php
$client = new \SlackApi\Client('your-token-here');
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

### Message and attachment objects

Create message object

```php
$client = new \SlackApi\Client('your-token-here');
$message = new \SlackApi\Models\Message($client);
```

or

```php
$client = new \SlackApi\Client('your-token-here');
$message = $client->makeMessage();
```

Create new attachment from array

```php
$data = [
    'fallback' => 'Some fallback'
    'pretext'  => 'Some pretext',
    'text'     => 'good',
    'text'     => 'Some text'
]; 
$attachment1 = new \SlackApi\Models\Attachment($data);
```

Or use set methods
```php
$attachment2 = new \SlackApi\Models\Attachment;
$attachment2->setText('Some text')
    ->setColor(\SlackApi\Models\Attachment::COLOR_GOOD)
    ->setFallback('Some fallback');
```

Add field to attachment

```php
$field = new \SlackApi\Models\AttachmentField;
$field->setShort(false)
    ->setTitle('Field title')
    ->setValue('Field value');
$attachment->addField($field);
```

Attach object to message
```php
$message->attach($attachment);
```

Send message
```php
$response = $message->send();
$response->toArray()
```

Author
-------

- [Ageev Pavel](mailto:ageev.pavel.v@gmail.com)
