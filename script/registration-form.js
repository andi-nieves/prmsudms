$(document).ready(() => {
  const form = $("#student-entry-form");
  form.on("submit", (event) => {
    event.preventDefault();
    $(form).find(".error").remove();
    $(form)
      .find("input, textarea, select").not('.not-required')
      .each((i, input) => {
        if (!input.value) {
          $(input)
            .closest(".input-wrapper")
            .append('<span class="error">This field is required</span>');
        } else {
          if (input.name === "email") {
            var validRegex =
              /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
            if (!input.value.match(validRegex)) {
              $(input)
                .closest(".input-wrapper")
                .append('<span class="error">Invalid email format</span>');
            }
          }
        }
      });
    if ($(form).find(".error").length > 0) return;

    $.ajax({
      url: `/api/student-entry.php?page=registration`,
      type: "post",
      dataType: "json",
      data: form.serialize(),
    }).done((data) => {
      if (data.duplicate) {
        data.duplicate.forEach(key => {
          $(`input[name="${key}"]`)
            .closest(".input-wrapper")
            .append('<span class="error">The value you entered already exists!</span>');
        })
        
      }
      if (data.success) {
        modal({
          title: 'Registration',
          body: 'Your registration is complete! Please check you email within 24 hours for approval status. Thank you!',
          onDismiss: () => {
            window.location = '/login.php'
          }
        })
      }
    });
  });

  $("[name='birthdate']").on("change", (event) => {
    const age = moment().diff(event.target.value, "years");
    $(".input-wrapper .static").html(age);
  });

});


