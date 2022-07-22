<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- PAGE STARTS -->
    <section class="contact--section">
        <div class="container">
            <div class="section--box">
                <div class="section--title center">
                    <div class="title">
                        <h1>Tell Us about your project</h1>
                    </div>
                    <div class="description">
                        <p>Hit us in any convenient way: give us a call, shoot us a email or fill the form below.</p>
                    </div>
                </div>
                <div class="contact--box">
                    <div class="contact--itembox">
                        <?php for ($i = 1; $i <= 3; $i++) { ?>
                            <div class="contact--item">
                                <div class="contact--itemtitle">
                                    <div class="title">
                                        <h5>Conact Title</h5>
                                    </div>
                                </div>
                                <div class="contact--itemdes">
                                    <ul>
                                        <li>Address Here</li>
                                        <li><a href="#">Contact Number</a></li>
                                    </ul>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="contact--formbox">
                        <span>OR</span>
                        <form action="" class="contact--form">
                            <div class="form--title">
                                <div class="title">
                                    <h5>Write a Message</h5>
                                </div>
                                <div class="description">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni, ut.</p>
                                </div>
                            </div>
                            <div class="form">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Please Enter your name">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Please Enter your Email">
                                </div>
                                <div class="form-group">
                                    <textarea rows="4" class="form-control" placeholder="Your Message"></textarea>
                                </div>
                                <div class="form-group">
                                    <div class="btn-holder">
                                        <button type="submit">Contact Us</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- PAGE ENDS -->
</body>

</html>