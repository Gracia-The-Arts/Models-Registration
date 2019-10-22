'use strict'
document.addEventListener('DOMContentLoaded', e => {
  let date = new Date()
  const year = date.getFullYear()
  let yearContent = document.querySelector('#year')
  yearContent.innerHTML = year

  // Get the referrer value from the URL
  const referrer = window.location.href.slice(
    window.location.href.indexOf('?') + 1
  )

  let formdata = referrer

  // initiate a fetch call
  axios
    .post('scripts/display.php', { referrer: formdata })
    .then(response => {
      // console.log(response.data)
      for (var i = 0; i < response.data.length; i++) {
        $('#data').append(
          '<tr><td>' +
            response.data[i].id +
            '</td><td>' +
            response.data[i].firstName +
            '</td><td>' +
            response.data[i].middleName +
            '</td><td>' +
            response.data[i].lastName +
            '</td><td>' +
            response.data[i].email +
            '</td><td>' +
            response.data[i].phone +
            '</td><td>' +
            response.data[i].address +
            '</td><td>' +
            response.data[i].occupation +
            '</td><td>' +
            response.data[i].gender +
            '</td><td>' +
            response.data[i].linkedin +
            '</td><td>' +
            response.data[i].twitter +
            '</td><td>' +
            response.data[i].instagram +
            '</td><td>' +
            response.data[i].facebook +
            '</td><td>' +
            response.data[i].skype +
            '</td><td>' +
            response.data[i].registered_at +
            '</td><td>' +
            response.data[i].paid +
            '</td><td>' +
            response.data[i].paid_at +
            '</td></tr>'
        )
      }
    })
    .catch(error => {
      console.log('The Request Failed', error)
    })
})
