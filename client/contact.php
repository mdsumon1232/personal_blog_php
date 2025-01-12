<?php require("./connection/connection.php")  ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>contact</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./css/contact.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>

<body>
    <!-- -----------header--------- -->
    <?php require('./share/header.php')  ?>
    <header class="contact-heading">
        <div class="contact-heading-content">
            <h1>যোগাযোগ করুন</h1>
            <p>আপনার প্রশ্ন বা পরামর্শ জানাতে আমাদের সাথে যোগাযোগ করুন। আমরা দ্রুত উত্তর দেব</p>
        </div>
    </header>

    <section class="contact-container">
        <form class="contact-form">
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" placeholder="Your Name" required>
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="Your Email" required>
            </div>

            <div class="form-group">
                <label for="message">Your Message</label>
                <textarea id="message" name="message" rows="5" placeholder="Write your message here..."
                    required></textarea>
            </div>

            <button type="submit" class="btn">Send Message</button>
        </form>

        <div class="contact-info">
            <h2> যোগাযোগের অন্যান্য উপায়</h2>
            <p>Email: <a href="mailto:sumonahamed5566@gmail.com">sumonahamed5566@gmail.com</a></p>
            <p>Phone: <a href="tel:01747533104">01747533104</a></p>
            <p>Follow me on social media:</p>
            <ul class="social-links">
                <li><a href="#" target="_blank">Facebook</a></li>
                <li><a href="#" target="_blank">Twitter</a></li>
                <li><a href="#" target="_blank">Instagram</a></li>
            </ul>
        </div>
    </section>


    <!-- --------------- footer---------- -->
    <?php require('./share/footer.php')  ?>

    <script src="./script/script.js"></script>
</body>

</html>