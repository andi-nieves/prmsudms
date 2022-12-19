$(document).ready(() => {
  $('input[name="amount"]').on({
    keyup: function () {
      formatCurrency($(this));
    },
    blur: function () {
      formatCurrency($(this), "blur");
    },
  });

  function formatNumber(n) {
    // format number 1000000 to 1,234,567
    return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  }

  function formatCurrency(input, blur) {
    // appends $ to value, validates decimal side
    // and puts cursor back in right position.

    // get input value
    var input_val = input.val();

    // don't validate empty input
    if (input_val === "") {
      return;
    }

    // original length
    var original_len = input_val.length;

    // initial caret position
    var caret_pos = input.prop("selectionStart");

    // check for decimal
    if (input_val.indexOf(".") >= 0) {
      // get position of first decimal
      // this prevents multiple decimals from
      // being entered
      var decimal_pos = input_val.indexOf(".");

      // split number by decimal point
      var left_side = input_val.substring(0, decimal_pos);
      var right_side = input_val.substring(decimal_pos);

      // add commas to left side of number
      left_side = formatNumber(left_side);

      // validate right side
      right_side = formatNumber(right_side);

      // On blur make sure 2 numbers after decimal
      if (blur === "blur") {
        right_side += "00";
      }

      // Limit decimal to only 2 digits
      right_side = right_side.substring(0, 2);

      // join number by .
      input_val = left_side + "." + right_side;
    } else {
      // no decimal entered
      // add commas to number
      // remove all non-digits
      input_val = formatNumber(input_val);
      input_val = input_val;

      // final formatting
      if (blur === "blur") {
        input_val += ".00";
      }
    }

    // send updated string to input
    input.val(input_val);

    // put caret back in the right position
    var updated_len = input_val.length;
    caret_pos = updated_len - original_len + caret_pos;
    input[0].setSelectionRange(caret_pos, caret_pos);
  }
  $('select').select2();
  $('form.auto').unbind("submit").bind('submit', async function (event) {
    event.preventDefault();
    const form = $(this);
    const data = form.data();
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
    if (data.unique) {
      $.ajax({
        url: `/api/crud.php?id=${data.id}&check=unique`,
        type: "post",
        dataType: "json",
        data: { keys: data.unique.map(key => { return { key, value: $(form).find(`[name="${key}"]`).val() } }), id: $(form).find('[name="id"]').val() },
      }).done((response) => {
        if (typeof response === 'object' && response.length > 0) {
          response.forEach(key => $(form).find(`[name="${key}"]`).closest(".input-wrapper")
            .append('<span class="error">The value you entered already exists!</span>'))
        } else {
          $.ajax({
            url: `/api/crud.php?id=${data.id}`,
            type: "post",
            dataType: "json",
            data: form.serialize(),
          }).done((data) => {
            form.trigger("success", data)
          });
        }
      });
    }
  })

  $(".modal .close").unbind('click').bind('click', function () {
    $(this).closest('.modal').hide();
    $(this).closest('.modal').find('form').trigger('reset')
  })
  jQuery.ajaxSetup({
    beforeSend: () => {
      $(".loader").show();
    }
  });
  $( document ).ajaxComplete(function() {
    $(".loader").hide();
  });

  $("#list").find('.dropdown .delete').on('click', function () {
    const data = $(this).data();
    window.modal({ title: "Are you sure you want to delete this record?", body: `Name: ${data.title}`, buttons: [{
      label: 'Yes',
      class: 'btn btn-default',
      action: () => {
        $.ajax({
          url: `/api/crud.php?id=${data.context}&type=delete`,
          type: "post",
          dataType: "json",
          data,
        }).done((data) => {
          window.location.reload();
        });
      }
    }]})
    
  });
  $('table').DataTable({
    language: { search: "" },
});
  $("#list_filter label").append('<i class="fa fa-search"></i>')
  $('table').find('th:contains("Date")').css('max-width', '100px')
});

