$(document).ready(() => {
  const form = $("#student-entry-form");
  form.on("submit", (event) => {
    event.preventDefault();
    $(form).find(".error").remove();
    $(form)
      .find("input, textarea, select")
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
      url: `/api/student-entry.php`,
      type: "post",
      dataType: "json",
      data: form.serialize(),
    }).done((data) => {
      if (data.success) {
        window.location = `/admin/students/entry.php?id=${data.id}`;
      }
    });
  });

  $("[name='birthdate']").on("change", (event) => {
    const age = moment().diff(event.target.value, "years");
    $(".input-wrapper .static").html(age);
  });

  $("#delete").on("click", function () {
    const data = $(this).data();
    window.modal({
      title: "Are you sure want to delete this record?",
      body: `Student Number: ${data.code}<br/>Name: ${data.name}`,
      buttons: [
        {
          label: "Delete",
          class: "btn-default",
          action: () => {
            $.ajax({
              url: `/api/student-entry.php?type=delete`,
              type: "post",
              dataType: "json",
              data,
            }).done((data) => {
              window.location = "/admin/student.php";
            });
          },
        },
      ],
    });
  });
});


