# Demo for AvantLink.

This is a demo task list with multi-user support for AvantLink.

This demo utilizes

* Laravel 5
* Angular 1.4


## Description

The task list uses Laravel for the back end and for compiling the front end (views).  Angular is used in the task list to render the view.

## Hurdles Overcome

* The first attempt was with Angular 1.5.x.
This worked great, except for the fact that there were no user documentation (e.g.: stackoverflow) about accessing a controller's functions from outside the controller (e.g.: in jQuery).
In the end, it was easier to switch to Angular 1.4.x, and loose the components and templates 1.5.x provided than to figure out undocumented code.
* Laravel and Angular both use the double curly bracket notation. `{{}}`
This was overcome by the use of the Laravel comment tag, `@{{}}`, which renders to the view as `{{}}` so that Angular can use it.

## Unit/Integration Testing

The user tests are minimalistic, as most of the functionality is provided by the frameworks, and their functionality is covered by their built-in tests.

