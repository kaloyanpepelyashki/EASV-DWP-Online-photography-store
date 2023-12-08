<form method="post" style="color:black" action="Controllers/sendemail.php">
    <div>
        <div style="display:inline-block">
            Email*<br>
            <input id="email" type="text" name="email">
        </div>
        <div style="display:inline-block">
            Subject*<br>
            <input id="subject" type="text" name="subject">
        </div>
    </div>

    <div>
        <div style="display:inline-block">
            <p>Name</p>*<br>
            <input id="name" type="text" name="name"><br>
        </div>
        <div style="display:inline-block">
            Company (optional)<br>
            <input id="company" type="text" name="company"><br>
        </div>
    </div>

    Message*<br>
    <textarea id="message" name="message" rows="15" cols="40"></textarea><br>
    <button id="submit" type="button" name="submit" onclick="sendEmail()">Send</button>
</form>