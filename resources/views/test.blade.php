@vite(['resources/scss/app.scss'])
<script>
    document.addEventListener("DOMContentLoaded", function () {
            const closeButton=document.getElementById("closeButton");
            const notification=document.querySelector(".notify-create-blog-error");

            // Check if the elements exist on the page
            if (closeButton && notification) {

                // Add a click event listener to the close button
                closeButton.addEventListener("click", function () {
                        // Hide the notification
                        notification.style.display = "none";
                    });
            }
        });
</script>
<div class="notify-create-blog-error">
    <div class="notify-icon">
        <i class="fa-solid fa-circle-exclamation"></i>
    </div>
    <div class="notify-body">
        <h3>Error</h3>
        <p>Your blog could not be created due to a system error. Please try again later!</p>
    </div>
    <div class="notify-close">
        <span id="closeButton">o</span>
    </div>
</div>
