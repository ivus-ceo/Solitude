function __ajaxUploadImage(e) {
  e.toBlob(function(blob) {
    let data = new FormData();
    data.append('file', blob, 'image.jpeg');
    data.append('file', e);
    /* Set new XMLHttpRequest */
    let xhr = new XMLHttpRequest();

    xhr.open('POST', 'index.php', true);

    xhr.onload = function() {
      if (xhr.status == 200) {
        console.log('200');
      }
    };

    xhr.send(data);
  }, 'image/jpg');
}

function __ajaxSearchQuery(e) {
  let dFormData = new FormData();
  dFormData.append('query', e.value);

  let eInputValue = e.value;
  let eInputDropdown = e.nextElementSibling.nextElementSibling;
  let eInputDropdownContent = eInputDropdown.querySelector('menu');

  let xhr = new XMLHttpRequest();

  xhr.open('POST', 'scripts/search-in-db.php', true);

  xhr.onload = function(e) {
    if (xhr.status == 200) {
      if (eInputValue.length == 1 || eInputValue.length > 1) {
        let dSearchQuery = JSON.parse(this.responseText);

        eInputDropdown.style.display = 'block';
        eInputDropdownContent.innerHTML = '';

        if (dSearchQuery.length > 0 && dSearchQuery.length != 1) {
          for (let i = 0; i < dSearchQuery.length; i++) {
            let eNewOption = document.createElement('li');
            eNewOption.setAttribute('onclick', '__funcSelectSearch(this)');
            eNewOption.innerHTML = dSearchQuery[i].article_title;
            eInputDropdownContent.appendChild(eNewOption);
          }
        } else if (dSearchQuery.length == 1) {
          let eNewOption = document.createElement('li');
          eNewOption.innerHTML = dSearchQuery[0].article_title;
          eNewOption.setAttribute('onclick', '__funcSelectSearch(this)');
          eInputDropdownContent.appendChild(eNewOption);
        } else {
          eInputDropdown.removeAttribute('style');
          eInputDropdownContent.innerHTML = '';
        }

      } else {
        eInputDropdown.removeAttribute('style');
        eInputDropdownContent.innerHTML = '';
      }
    }
  };

  xhr.send(dFormData);
}
