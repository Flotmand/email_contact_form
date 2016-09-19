# email_contact_form
Simple contact form that sends an email with the content + send a copy to the sender.

This is a simple contact form that sends the content to an email address specified as a parameter in the contact_form()-function.
The $site_url is used in the final email to tell the recipient from which website the message has been sent.
If you want a certain string instead, just type that as the parameter.

If all the fields is not filled out, the email will not get send, and the user will get an error message instead.

Personally I am using this contact form in a wordpress template like this:

                contact_form(get_bloginfo('admin_email'), get_site_url());
                
That way the site owner can change til email address connected to his website, and the contact form wil change as well.

Feel free to copy the code and/or suggest improvements. 

// Lars Svendsen
September 19 2016

Email: lars@svndsn.dk
