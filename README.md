# CiviCRM: External Hours Tracking

Creates activities of type "Service Hours" based on time log records from an external
tracking system (currently supports only Kimai v1). See below for important requirements,
including mods to your Kimai instance.

The extension is licensed under [GPL-3.0](LICENSE.txt).

## Requirements

* [Kimai v1 integration with CiviCRM](https://github.com/twomice/kimai1_civicrm):
  provides additional APIs and custom tables in your Kimai instance to facilitate communication
  with CiviCRM.
* PHP v7.0+
* CiviCRM 5.0


## Summary of functionality
This extension allows you to establish an authenticated link with your Kimai instance. After proper
configuration, the extension will periodically query Kimai for recent changes (additions, modifications,
and deletions) of Kimai timesheet entries, which will be synced into CiviCRM as activities of the
type "Service Hours".

* Each timesheet entry will equate to one activity record.
* The **Kimai Project** for a given timesheet entry will map to a single **organization contact** in CiviCRM
  (see "Installation and setup" below). Take note: there is no linkage related to Kimai Customers; the
  fundamental linkage is with Kimai Projects; thus the assumption here is that you have one Kimai Project
  per customer, and that each relevant project can be mapped to a single organization contact in CiviCRM.
* An activity created from a given timesheet entry will be deleted if that timesheet entry is deleted;
  likewise it will be updated (change the organization, duration, description, etc.) to match equivalent
  change in Kimai.
* Polling of Kimai data is performed by a Scheduled Job calling the `exthours.getkimaiupdates` api; this
  scheduled job is configured to run "at every cron run" by default.

## Installation and setup
1. See [Kimai v1 integration with CiviCRM](https://github.com/twomice/kimai1_civicrm) for important
   changes to your Kimai instance to facilitate communication with CiviCRM through this extension.
   Apply those changes to your Kimai instance.
2. Install this extension in your CiviCRM instance.
3. In CiviCRM, navigate to Administer > System Settings > External Hours to establish an authenticated
   communication link with Kimai, and to configure the linkage between Kimai projects and CiviCRM organizations.
4. Configure the "Call ExtHours.Getkimaiupdates API" Scheduled Job as desired, or leave it to run
   with its default settings.


## Support
![logo](/images/joinery-logo.png)

Joinery provides services for CiviCRM including custom extension development, training, data migrations, and more.
We aim to keep this extension in good working order, and will do our best to respond appropriately to issues
reported on its [github issue queue](https://github.com/twomice/com.joineryhq.exthours/issues). In addition,
if you require urgent or highly customized improvements to this extension, we may suggest conducting a
fee-based project under our standard commercial terms.  In any case, the place to start is the [github
issue queue](https://github.com/twomice/com.joineryhq.exthours/issues) -- let us hear what you need and
we'll be glad to help however we can.

And, if you need help with any other aspect of CiviCRM -- from hosting to custom development to strategic
consultation and more -- please contact us directly via https://joineryhq.com