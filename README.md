# Kirby Plugin: MyTumblr

This plugin allows you to show recent posts for a Tumblr account on your Kirby site

## Git submodule

```
git submodule add https://github.com/mirthe/kirby_mytumblr site/plugins/mytumblr
```

## Usage

To get an key you must register an application.
You'll need this to get your API key, even if you don't ever need to use a fully signed OAuth request.
https://www.tumblr.com/oauth/apps

Add the following to your config where XX is your key and YY your Tumblr subdomain:

    'tumblr.apiKey' => 'XX',
    'tumblr.domain' => 'YY.tumblr.com',
    'tumblr.limit   => 30

Include this snippet to display your tumblr posts on a page

    <?php snippet('tumblr-posts'); ?>

## Example 

https://mirthe.org/gevonden

<img src="example.png" alt="Example">

## Todo

- Offer as an official Kirby plugin
- Add sample SCSS to this readme
- Cleanup code
- Lots..
