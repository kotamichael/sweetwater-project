# Sweetwater Take-home Project

Thanks for your interest in working at Sweetwater! We’re always excited to meet awesome people. We’ve created this test to help us understand your programming chops.

When placing orders on a website, we provide a field for customers to add a quick comment to tell us something we should know about them or their order. We’re supplying you a MySQL table with these various comments and want to see your approach the following tasks.

## Task 1 - Write a report that will display the comments from the table

Display the comments and group them into the following sections based on what the comment was about:
- Comments about candy
- Comments about call me / don’t call me
- Comments about who referred me
- Comments about signature requirements upon delivery
- Miscellaneous comments (everything else)

## Task 2 - Populate the shipdate_expected field in this table with the date found in the `comments` field (where applicable)

The shipdate_expected field is currently populated with no date (0000-00-00). Some of comments included an “Expected Ship Date” in the text. Please parse out the date from the text and properly update the shipdate_expected field in the table

## How you’ll build it

- You can use any VCS platform you like — such as Gitlab or Github — as long as your project is publicly accessible.
- Build your application so we can test it in-browser.
- Write your application using PHP
- We’re interested in functionality, not design. It doesn’t have to look pretty but your code should :-)
- Don’t use any other JavaScript libraries, such as jQuery.
- Once you’re done, send us the link to your project so we can look it over.

## Requirements

- **Commit often.** We want to see your progress throughout the project.
- **Work quickly.** This project was designed to be completed quickly, so don’t spend too much time on it.
- **Write your own code.** While we understand that there are pakages out there that take care of common problems, we ultimately want to see what *YOU* can build, not what someone else has built.
- **Do your best work.** We’re using this project as a viewport into who you are as a developer. Show us what you can do!

# My Experience

## Issues

Datetime insert issue: incorrect formatting for newer MySQL. Had to use mass edit to set all 0 datetimes to 0.

## Process

1. Start with building model
    1. Alias sweetwater_test into orders model
    2. Made orderid pk so it can be queried in the future
2. Need to work on controller
    1. ~~pull all comments and use helper to categorize~~
    2. Simple enough to utilize scopes for string searches for now.
3. Use migration to update shipexpected_dates into correct date from comment using RegEx
4. Refine

## Refinements/TODO

Add proper pk field to orders: might not be able to trust outside ids to be unique

Make categories editable through UI: allows Analysts to update categories based on needs

Find a better way to handle the everything else scope: maybe move scope entirely over to the service (no real reason to still be in model)

More foolproof way of catching correct date strings from expected ship dates (lock onto string maybe? If guaranteed?)

Further testing—especially around scopes