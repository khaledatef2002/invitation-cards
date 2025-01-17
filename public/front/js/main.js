$(".page-style-item").click(function(){
    $(".page-style-item[selected='selected']").removeAttr("selected")
    $(this).attr("selected", "selected")  
})

generate_captcha()

$(".submit-holder button").click(function(){
    var button = this
    var type = $(".page-style-item[selected='selected']").attr("data-type")
    var name = $(".input-holder input").val()
    var captcha = $(".recaptacha-holder input").val()

    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: "/invitation/generate/" + type,
        type: "POST",
        data: {type, name, captcha},
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        xhrFields: {
            responseType: 'blob'
        },
        success: function(response) {
            console.log(response);

            var blob = new Blob([response], { type: 'image/jpeg' });
            var link = document.createElement('a');
            link.href = window.URL.createObjectURL(blob);
            link.download = 'generated_card.jpg';
            document.body.appendChild(link);
            link.click();
            
            // document.body.removeChild(link);

            // var link = document.createElement('a');
            // link.href = data.link;
            // link.download = 'greeting_card.png';  // Specify the file name
            // document.body.appendChild(link);
            // link.click();  // Simulate click to trigger the download
            // document.body.removeChild(link);  // Clean up
            
            // $(".recaptacha-holder input").val("");
            // $(".input-holder input").val("");
            // generate_captcha();
        },
        error: function(data) {
            const error = JSON.parse(data.responseText);
            Swal.fire({
                icon: "error",
                title: "خطأ",
                text: error.message
            });
        },
    });
})

function generate_captcha()
{
    $('.recaptacha-holder img#captcha').attr("src", '/captacha/generate?' + Date.now());
    
}

$('#hear-captcha').click(function() {
    fetch('/captacha/read')
    .then(response => response.json())
    .then(data => data.captcha_code)
    .then(captcha => {
        var formattedCaptcha = captcha.split('').join(' '); // Convert to "5 1 0"
        const utterance = new SpeechSynthesisUtterance(formattedCaptcha); // Create speech utterance
        window.speechSynthesis.speak(utterance); // Speak the CAPTCHA code
    })
});