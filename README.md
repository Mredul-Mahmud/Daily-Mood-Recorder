Project name : Daily Mood Tracker.

Features and Functionality Breakdowns: 
i). Authentication: In this applycation users can register 5their account and then login with "Phone Number" and "Password". The Authentication system was created using Laravel Breeze. Upon a successful login the user will be redirected to the dashboard where they will have access to their profile info and "Logout" system. They can also change their profile info and password.
ii). Mood Record Management: A CRUD operation has been built for tracking mood. Here an user can select their daily mood from a dropdown. An user can only select their mood once a day. and they can save it along with an additional optional note. The note can be changed anytime. The userr's only can have access to their own moods. The user's are restricted to have access in different user's Mood entries record. The "moods" tagble has user_id as a foreign key that is used to buit a has many(one-to-many) relationship between the two tables. An user can also search their Mood with "Dates". And they will also have  an option for filter the results with dates. Using this application the users can soft delete their entries from the records. but the entries will be moved into trash/bin, from where they can be restored again. And based on the entries of a whole month, user's will see a result how was their mood during the month.
If an user posts their record for at least 3 consecutive days, then it will show a streak badge in their account, and the day number will increase as they go by.
iii). Records Visualize: User's have options to see their weekly mood statistics in a Bar chart. The chart with render using the previous 7 days data. It was created using Chart.Js
iv) Record Download: The users have the optioons for download a pdf of a list that contains all of the "Mood Entries" they have recorded so far.

UI Design: A very simple and minimal usage of Bootstrap 5 is implemented in this web application.
