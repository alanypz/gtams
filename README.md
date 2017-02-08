# GTA Management System

A web application for managing the selection of graduate teaching assistants (GTAs).

Presentation tier created using HTML, CSS, Javascript. Server was implemented using PHP and interfaced with MySQL database.

## Functionality Overview

GTAMS supports four different types of users:

1. Nominators
2. GTA Nominees
3. Graduate Committee Member
4. System Adminstrator

Faculty members at the University will nominate (Nominators) students (GTA Nominees). Graduate Committee Members then review the nominations and select the nominees. The System Administrator is responsible for creating and managing the nomination sessions each semester.

### Nominator Functions

* Login
* Fill out online nomination form
* Submit online nomination form (with GTA Nominee email)
* Review GTA Nominee's application
* Approve GTA Nominee's application

### GTA Nominees

* Access GTAMS through email URL
* Fill out online information form
* Submit online information form

### Graduate Committee Member

* Login
* View table of GTA Nominee applicants
* Sort table by columns (fields from online information form)
* Click a student name from table to view information form
* Enter score for any applicant

### System Adminstrator

* Login
* Fill out session creation form
* Submit session creation form
* Set deadlines for nomination session
* View archive of previous nomination session