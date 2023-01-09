//Compose template string
String.prototype.compose = (function (){
  var re = /\{{(.+?)\}}/g;
  return function (o){
      return this.replace(re, function (_, k){
          return typeof o[k] != 'undefined' ? o[k] : '';
      });
  }
}());
function inactivityTime() {
  let time;
  $(document).ready(resetTimer).mousemove(resetTimer).on('keypress', resetTimer);
  function logout() {
    $.ajax({
      url: `/api/login.php?destroy=true`,
      type: "get",
      dataType: "json",
    }).done(() => {
      window.location.replace('/')
    });
  }
  function resetTimer() {
    clearTimeout(time);
    time = setTimeout(logout, (1000 * 30 * 10)) // 5mins inactive
  }
};
$(document).ready(() => {
  inactivityTime();
  $('input[name="price"]').on({
    keyup: function () {
      formatCurrency($(this));
    },
    blur: function () {
      formatCurrency($(this), "blur");
    },
  });
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
      .not('.not-required')
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

    if ($(form).find("[name='amount']").length > 0) $(form).find("[name='amount']").val(Number($(form).find("[name='amount']").val().replace(/[^0-9.-]+/g, "")))
    if ($(form).find("[name='price']").length > 0) $(form).find("[name='price']").val(Number($(form).find("[name='price']").val().replace(/[^0-9.-]+/g, "")))
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

  window.rebindDelete = function() {
    $("#list").find('.dropdown .delete').on('click', function () {
      const data = $(this).data();
      const stay = $(this).hasClass('stay');
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
            if (!stay) window.location.reload();
            $(this).trigger('done', [data])
          });
        }
      }]})
    });
  }
  window.rebindDelete()
  const tableOptions = {
    language: { search: "" },
    width: '100%'
  }
  const tblRaw = $('table.table')
  if (tblRaw.hasClass("no-pagination")) {
    tableOptions.paging = false
  }
  $('table.table').find('th:contains("Date")').css('max-width', '100px')
  const table = tblRaw.DataTable(tableOptions);
  // window.table = table
  $('table.table').trigger('done', [table])
  $("#list_filter label").append('<i class="fa fa-search"></i>')
  
});

