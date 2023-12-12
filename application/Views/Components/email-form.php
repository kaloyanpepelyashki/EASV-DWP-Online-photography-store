<hr style="width: 37.5rem;">
<form method="post" style="" action="Controllers/sendemail.php">

    <div>
        <div style="display:inline-block">
            <p>Email*</p><br>
            <input id="email" type="text" name="email">
        </div>
        <div style="display:inline-block">
            <p>Subject*</p><br>
            <input id="subject" type="text" name="subject">
        </div>
    </div>

    <div>
        <div style="display:inline-block">
            <p>Name*</p><br>
            <input id="name" type="text" name="name"><br>
        </div>
        <div style="display:inline-block">
            <p>Company (optional)</p><br>
            <input id="company" type="text" name="company"><br>
        </div>
    </div>

    <p>Message*</p><br>
    <textarea id="message" name="message" rows="15" cols="40"></textarea><br>
    <button id="submit" type="button" name="submit" onclick="sendEmail()">Send</button>
</form>