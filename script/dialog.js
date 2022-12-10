window.modal = ({ title, body, buttons }) => {
  /*
        buttons = [{
            label: string,
            class: string,
            action: function
        }]
    */

  $("#modal .card-title").html(title);
  $("#modal .content").html(body);
  $("#modal .action-button").html("");
  const actions = $("#modal .action-button");
  const defBtn = () => {
    actions.append('<button class="btn btn-flat" type="submit">Close</button>');
    actions.find(".btn-flat").on("click", () => {
      $("#modal").hide();
    });
  };
  if (buttons) {
    buttons.forEach((button) => {
      actions.append(
        $(
          `<button class='btn ${button.class} m-r'>${button.label}</button>`
        ).on("click", () => {
          button.action();
          $("#modal").hide();
        })
      );
    });
    defBtn();
  }
  if (!buttons) {
    defBtn();
  }

  $("#modal").show();
};
window.hideModal = () => {
  $("#modal").hide();
};

$(document).ready(() => {
  $(".modal .action-button .btn-flat").on('click', function() {
    $(this).closest('.modal').hide()
  })
})

