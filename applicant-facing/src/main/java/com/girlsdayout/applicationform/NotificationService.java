package com.girlsdayout.applicationform;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.core.io.FileSystemResource;
import org.springframework.mail.javamail.JavaMailSender;
import org.springframework.mail.javamail.MimeMessageHelper;
import org.springframework.stereotype.Service;

import javax.mail.MessagingException;
import javax.mail.internet.MimeMessage;
import java.io.File;

@Service
public class NotificationService {

    //creating javaMailSender object
    @Autowired
    private JavaMailSender javaMailSender;

    public void sendNotification(Applicant a) throws MessagingException {

        //creating a new email object
        MimeMessage mail = javaMailSender.createMimeMessage();

        //creating helper object needed to add to/from/content/attachments to e-mail
        MimeMessageHelper helper = new MimeMessageHelper(mail, true);

        //getting the parents email from the passed applicant object, and setting it as the "email receiver"
        helper.setTo(a.getParentEMail());

        //setting the email sender in the mail object
        helper.setFrom("GDOTestEmail@gmail.com");

        //setting the email subject
        helper.setSubject("Girls Day Out 2020 Test E-Mail");

        //setting the email body
        helper.setText("Hello " + a.getfName() + ",\n\n" +
                "Thank you for your application for the 2020 summer camp Girls Day Out!\n" +
                "Your Record ID is: " + a.getRecordId() +
                "\n You may also view your application status here: localhost:8080/application/status/" +
                a.getRecordId() +
                "\nn Please visit this link to submit your waivers if you haven't already " +
                "done so: localhost:8080/waiver/" + a.getRecordId() + "\n\n");

        //creating new attachment objects
        FileSystemResource waiverOne = new FileSystemResource(new File("src/main/resources/static/waiverone.pdf"));
        FileSystemResource waiverTwo = new FileSystemResource(new File("src/main/resources/static/waivertwo.pdf"));
        FileSystemResource waiverThree = new FileSystemResource(new File("src/main/resources/static/waiverthree.pdf"));

        //adding the attachment objects to the e-mail/helper object
        helper.addAttachment("Waiver One", waiverOne);
        helper.addAttachment("Waiver Two", waiverTwo);
        helper.addAttachment("Waiver Three", waiverThree);

        //sends the email object through javaMailSender
        javaMailSender.send(mail);

    }
}
