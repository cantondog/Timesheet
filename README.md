Timesheet
=======================
This timesheet app was written based on a need at my company. It had some specifics that are required which may not necessarily apply to other places. Shortly after it was created, circumstances beyond our control forced us in a different direction. So I put it here on github in case it helps anyone.

Installiation
=======================
 1. Create a new DB
 2. Run the timesheet-clean-install.sql script
 3. Make sure you update the database.php file.
 4. Change `BASE_URL` variable in `app/Config/bootstrap.php` file

Usage
=======================
Three users are created initially

  - admin
  - manager
  - test

All users are set with the initial password of `123456`

**Masters** are the timesheet 'templates'. It's basically a period of time that you want for each timesheet. Masters are created manually. It's not automatic since we didn't really have a set number of days in each time period.

You have to create `Masters` before your `regular` users can fill out timesheets.

`admin` user has control over the whole app. They can add _masters_, edit users, and are the final approval on all timesheets. Admin users can also export sheets as a csv file. Admin can approve multiple timesheets at the same time.

`manager` users are the first approval on timesheets. They review and approve timesheets for people in their department only. Managers can only approve 1 sheet at a time. This is deliberate since managers should review to make sure their users fill the timesheet out correctly. :-)

`regular` users can only see their timesheets.

In the dashboard, `regular` users can set default times. If they do, then when they start a new timesheet, the times will default to these settings. If a user does not set this then their times when they open a new timesheet will be 8am - 12pm & 1pm - 5pm.

OT will be automatically calculated based on an 8 hour day (meal period automatically calculated too).

Makeup time: If a user works less than 8 hours in a day but wants to make that up by working more than 8 hours on a different day (or days), they can check the `makeup` box _on the days they work more_. This will not calculate OT for those days. If a user works more than 11 hours in a day though, OT will accrue even if the `makeup` box is checked. Note that there is no validation on the `makeup` check box. 

`regular` users can't see timesheets in the future (so create as many masters as you want). Nor can they see timesheets before their `Hire Date`.

Workflow (once masters are created) is: `regular` user fills out timesheet --> submits to manager --> manager reviews (can send back to regular user) --> approved by manager gets sent to admin --> admin then approves.

Other Settings
-----------------------
You can change the `COMPANY_NAME` in the `app/Config/bootstrap.php` file.


TODOs
-----------------------
This was to originally have a `phase2` but we didn't get that far. Maybe I will expand this out still but I don't have any short-term plans to. So, there are a few things you might want to know.

  - Departments: Currently there's no way to edit/add/delete Departments. This can be easily done directly in the SQL though. Departments set up on install are Executives, Client Services, Creative, Data, Production, Technology
  - You need to add a holiday _before_ you add a **master**.
  - PTO is automatically calculated, but there isn't a way to submit PTO via the app. That was the plan for a later release.
  - There was more functionality that we planned on adding in. As well, there are probably bugs in the app too (although we did QA it a lot).