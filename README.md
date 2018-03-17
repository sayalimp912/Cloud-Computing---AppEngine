Cloud_Computing_16SS_HW3
========================

<snippet>
  <content>
# Using AppEngine for Serving Dynamic Web Content

## Google AppEngine web services used - 
1. Google User Management - 
The web service can detect whether the current user has signed in, and can redirect the user to the appropriate sign-in page.
2. Memcache - 
It is used to speed up common datastore queries.

## What the service does - 
The web service finds your lucky number from your BirthDate.
Example, If you are born on 12th December 1990 (12/12/1990), the php code adds up all the digits from your birthdate. 1+2+1+2+1+9+9+0 = 25 and returns the addition.
Thus your lucky number is 25!
This service is available only for authentic google users and Google User Management takes care of it.
If the same birthdate is already entered, the service fetches the result from the cache rather than computing it again. Every time a new birthdate is entered, it stores the result in cache. This is handled by Memcache.

## Author - 

Sayali Pendharkar


</content>
</snippet>
