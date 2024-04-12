<!-- footer -->
    <!--footer starts from here-->
    <footer class="footer">
        <div class="container bottom_border">
            <div class="row">

                <div class=" col-sm-3  col-6" style="text-align: center;">
                    <h5 class="headin5_amrc col_white_amrc pt2">
                        معلومات
                    </h5>
                    <!--headin5_amrc-->
                    <ul class="footer_ul_amrc">
                        <li>
                            <a href="http://webenlance.com">
                            بنود الاستخدام
                            </a>
                        </li>
                        <li>
                            <a href="http://webenlance.com">
                                القوانين
                            </a>
                        </li>
                        <li><a href="http://webenlance.com">
                            عن الموقع
                        </a></li>
                        <li><a href="http://webenlance.com">
                            موقع الإحصائيات
                        </a></li>
                        <li><a href="http://webenlance.com">
                            طريقة الرفع
                        </a></li>

                    </ul>
                    <!--footer_ul_amrc ends here-->
                </div>


                <div class=" col-sm-3 col-6 " style="text-align: center;">
                    <h5 class="headin5_amrc col_white_amrc pt2">
                        الصفحات
                    </h5>
                    <!--headin5_amrc-->
                    <ul class="footer_ul_amrc">
                        <li><a href="index.php">
                            القائمة الرئيسية

                        </a></li>
                        <li>
                            <a href="manga.php">
                                قائمة المانجا
                            </a>

                        </li>
                        <li><a href="blog.php">
                            المقالات
                        </a></li>

                    </ul>
                    <!--footer_ul_amrc ends here-->
                </div>


                <div class=" col-sm-6   col-12 contact_footer" style="text-align: center;">
                    <h5 class="headin5_amrc col_white_amrc pt2">اترك لنا رسالة </h5>
                    <form name="myForm" action="sendmsg.php" onsubmit="return validateForm()" method="post">
                        <table class="form-style">
                            <tr>
                                <td>
                                    <label>
                                   إسمك : <span class="required">*</span>
                                </label>
                                </td>
                                <td>
                                    <input type="text" name="name" required='required' class="long" />
                                    <span class="error" id="errorname"></span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>
                                   عنوان بريدك الاليكتروني : <span class="required">*</span>
                                </label>
                                </td>
                                <td>
                                    <input type="email" name="email"required='required' class="long" />
                                    <span class="error" id="erroremail"></span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>
                                   الرسالة : <span class="required">*</span>
                                </label>
                                </td>
                                <td>
                                    <textarea name="message" required='required' class="long field-textarea"></textarea>
                                    <span class="error" id="errormsg"></span>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <input type="submit" value="إرسال">
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>


        <div class="container">
            <ul class="social_footer_ul">
                <li><a href="https://facebook.com/groups/724678405385425/"><i class="fab fa-facebook-f"></i></a></li>
                <li><a href="https://facebook.com/groups/724678405385425/"><i class="fab fa-twitter"></i></a></li>
                <li><a href="https://facebook.com/groups/724678405385425/"><i class="fab fa-linkedin"></i></a></li>
                <li><a href="https://facebook.com/groups/724678405385425/"><i class="fab fa-instagram"></i></a></li>
            </ul>
            <!--foote_bottom_ul_amrc ends here-->
            <p class="text-center">Copyright @2017 | Designed With by <a href="#" class="companyname">AMURA MANGA</a></p>


            <!--social_footer_ul ends here-->
        </div>

    </footer>

    <!-- go to top  -->
    <div onclick="topFunction()" id="go_to_top" title="Go_to_top">
        <i class="fa-solid fa-arrow-up"></i>
    </div>


    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!--<script src="layout/js/bootstrap.bundle.js"></script>-->
    <script>
        let mybutton = document.getElementById("go_to_top");

        // When the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function() {
            scrollFunction()
        };

        function scrollFunction() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                mybutton.style.display = "block";
            } else {
                mybutton.style.display = "none";
            }
        }

        // When the user clicks on the button, scroll to the top of the document
        function topFunction() {
            document.body.scrollTop = 0; // For Safari
            document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
        }
    </script>
</body>

</html>
