# Aristek Systems PHP Symfony Test Task

### Description

We have 2 models "Project" and "Contact" in our Application. We already have some data in our storage.

Project has next properties:
- id;
- name - string 50 only space and latin letters in any case, min length - 5;
- code - string 10 only latin letters in lower case, min length - 3, can not be changed;
- url - only valid urls from domain example.com;
- budget - BYN amount,
- contacts - collection of Contact, at least one is required.

Contact has next properties:
- id;
- firstName - string 50;
- lastName - string 50;
- phone - mask +xxx (xx) xxx-xx-xx;

We need to create API to perform CRUD for Project:
- Endpoints:
  - List:
    - Method: GET
    - URI: /projects
    - Allow filtering by code with partial match and budget between
    - Response:
      ```json
      [
        {
          "id": 1,
          "name": "Project",
          "code": "project",
          "url": "http://example.com/my-page",
          "budget": 100,
          "contacts": [
            {
              "id": 1,
              "firstName": "John",
              "lastName": "Doe",
              "phone": "+012 (34) 567-89-10"
            }     
          ]
        }
      ]
      ```
  - Single Item:
    - Method: GET
    - URI: /projects/[id]
    - Response:
      ```json
      {
        "id": 1,
        "name": "Project",
        "code": "project",
        "url": "http://example.com/my-page",
        "budget": 100,
        "contacts": [
          {
            "id": 1,
            "firstName": "John",
            "lastName": "Doe",
            "phone": "+012 (34) 567-89-10"
          }
        ]
      }
      ```
  - Create:
    - Method: POST
    - URI: /projects
    - Request:
      ```json
      {
        "name": "New Project",
        "code": "np",
        "url": "http://example.com/new-page",
        "budget": 100,
        "contacts": [
          {
            "firstName": "Jane",
            "lastName": "Doe",
            "phone": "+012 (34) 567-89-10"
          }   
        ]
      }
      ```
    - Response:
      ```json
      {
        "id": 2,
        "name": "New Project",
        "code": "np",
        "url": "http://example.com/new-page",
        "budget": 100,
        "contacts": [
          {
            "id": 2,
            "firstName": "Jane",
            "lastName": "Doe",
            "phone": "+012 (34) 567-89-10"
          }   
        ]
      }
      ```
  - Update:
    - Method: PATCH
    - URI: /projects/1
    - Request:
      ```json
      {
        "name": "New Name"
      }
      ```
    - Response:
      ```json
      {
        "id": 1,
        "name": "New Name",
        "code": "project",
        "url": "http://example.com/my-page",
        "budget": 100,
        "contacts": [
          {
            "id": 1,
            "firstName": "John",
            "lastName": "Doe",
            "phone": "+012 (34) 567-89-10"
          }
        ]
      }
      ```
  - Delete:
    - Method: DELETE
    - URI: /projects/1

### Requirements

- Authentication by secret key in URL;
- PHP 7.*;
- Symfony >= 4 (preferable) or plain PHP/any other framework;
- any RDBMS;
- add some unit tests to the application (no need to cover all, only show the principles).
