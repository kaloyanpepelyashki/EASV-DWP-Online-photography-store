
    <form method="post" action="Controllers/sendemail.php">
        <div>
            <div style="display:inline-block">
                Email*<br>
                <input type="text" name="email">
            </div>
            <div style="display:inline-block">
                Subject*<br>
                <input type="text" name="subject">
            </div>
        </div>
        
        <div>
            <div style="display:inline-block">
                Name*<br>
                <input type="text" name="name"><br>
            </div>
            <div style="display:inline-block">
                Company (optional)<br>
                <input type="text" name="company"><br>
            </div>
        </div>
        
        Message*<br>
        <textarea name="message" rows="15" cols="40"></textarea><br>
        <input name="submit" type="submit" value="Submit">
    </form>