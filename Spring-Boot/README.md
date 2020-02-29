## Info on the Back-end <br>
All the files needed for the back-end part of the project that inputs the data from the application form into the database. Let me start off by saying if you have any problems, message the discord or e-mail me and I'll try and help out. First time using spring boot so working out the kinks myself.

The pom.xml file has all the dependencies that are injected into the program, which makes it much easier to build.

## Getting the program to run <br>
To get the program to run, it needs to be imported as a maven project. I have been using IntelliJ, but I believe if you use "Open Project From the File System" in Eclipse, it will automatically detect it as a maven build. Running in Eclipse or IntelliJ will start the program on port 8080, as long as you don't already have a process listening on that port.

You may have to create a mysql database locally and change the application.properties file in src/main/resources to reflect that. You only need to create the database, and a user that has privileges for the DB. No need to configure tables and columns, the spring boot app will do that on its own.

## Entering data into the database and returning all applicant info <br>

The html for the application form is now integrated with the back-end. Once the program is running, go to localhost:8080/application.html and you will see the skeleton of the application form, no styling yet. Make sure all data is input into the form, and on submit you should be brought to a new page that says "The application has been submitted successfully. Please check your e-mail for confirmation." Whatever you entered for the Mom's e-mail is the parentEMail - which will receive the confirmation e-mail sent out by the back-end. There is a button 

## Entering data via terminal/command-line <br>
If you want to input data into the database from the terminal, use what I pasted below. You can change the values to fit what you want. I believe the parent e-mail you enter will receieve an e-mail if the data below is submitted successfully. If you want to retrieve all info in the DB, use "curl localhost:8080/application/all"

curl localhost:8080/application/submit -d fName=Molly -d lName=Smith -d address=15_Smith_Street -d city=Charleston -d state=SC -d zipCode=29401 -d phoneNumber=5551234567 -d dateOfBirth=10112007 -d age=12 -d ethnicity=Caucasian -d allergies=none -d medications=none -d parentsCollege=Yes -d militaryRelatives=no -d fallSchool=Berkeley -d risingGradeLevel=9th -d collegeOfInterest=Clemson -d shirtSize=Medium -d parentFName=Oliver -d parentLName=Smith -d parentEMail=matthewhunt25559@my.tridenttech.edu -d parentAddress=15_Smith_Street -d parentCity=Charleston -d parentState=SC -d parentZipCode=29401 -d parentMobilePhone=5551234567 -d parentWorkPhone=1234567890 -d parentHomePhone=1234567890 -d otherParentFName=Alyssa -d otherParentLName=Smith -d contactName=Jacob_deGrom -d relationship=Cy_Young -d contactAddress=2_Cy_Young_Way -d contactCity=Flushing -d contactState=NY -d contactZipCode=31205 -d contactMobilePhone=1234567890 -d contactWorkPhone=1234567890 -d contactInitials=JD

## Gaps between the form/back-end database/face-to-face database <br>
The database that I put together for the back-end doesn't match what the face-to-face group put together. It also doesn't fully match what the front-end form asks for. I'm sure this will change down the road. Once we nail down exactly what information the client needs, we will change the front-end/back-end to match that. The same goes for matching the back-end processing with the database the face-to-face group put together.
