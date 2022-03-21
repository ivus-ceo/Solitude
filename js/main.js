/* Toggle cookie on click*/
function __funcSwitch(e) {
  e.getAttribute('value') == 0 ? e.setAttribute('value', 1) : e.setAttribute('value', 0);
}
/* Display password in form input */
function __funcDisplay() {
  const a = document.querySelector('input[name="user_password"]');
  a.getAttribute('type') == 'password' ? a.setAttribute('type', 'text') : a.setAttribute('type', 'password');
}
/* Button ripple effect on click */
function __funcRippleEffect(e) {
  const buttons = document.querySelectorAll('button');

  buttons.forEach((button, i) => {
    button.addEventListener('click', function(e) {
      let x = event.offsetX;
      let y = event.offsetY;

      let ripples = document.createElement('span');
      ripples.setAttribute('class', '__ripple');
      ripples.style.left = x + 'px';
      ripples.style.top = y + 'px';
      this.appendChild(ripples);

      setTimeout(() => {
        ripples.remove();
      }, 1000);
    });
  });
}
/* Display modal container */
function __funcDisplayModal(id1, parameter1, parameter2) {
  const modalParent = document.querySelector('.__footer-container-wrapper');
  const modalChild = document.querySelector(`#${id1}`);
  modalParent.style.display = parameter1;
  modalChild.style.display = parameter2;
}
/* Display modal container with confirmation buttons */
function __funcDisplayConfirmationModal(id1, id2, message1, message2, message3, callback) {
  const modalConfirm = document.querySelector('#__modal-confirmation');
  const modalChild = document.querySelector(`#${id1}`);
  const modalMessage = document.querySelector(`#${id2}`);
  const buttons = document.querySelectorAll('.__confirmation-buttons button');
  const buttonFailure = buttons[0];
  const buttonSuccess = buttons[1];

  modalConfirm.style.maxWidth = '300px';
  modalConfirm.style.display = 'block';
  modalChild.style.display = 'none';
  modalMessage.innerHTML = message1;
  buttonFailure.innerHTML = message2;
  buttonSuccess.innerHTML = message3;

  buttons.forEach((button, i) => {
    button.addEventListener('click', function(e) {
      if (button.id === '__answer-failure') {
        modalConfirm.style.display = 'none';
        modalChild.style.display = 'block';
        callback(false);
      } else if (button.id === '__answer-success') {
        modalConfirm.style.display = 'none';
        modalChild.style.display = 'block';
        callback(true);
      }
    });
  });
}
/* Display cropper container */
function __funcCropperModal(dFile) {
  if (dFile.files && dFile.files[0]) {
    const eCroppingImage = document.querySelector('#__cropper-image');
    const eUserAvatar = document.querySelector('#__avatar-image');
    const eBtnClose = document.querySelector('.__cropper-times');
    const eBtnSuccess = document.querySelector('button[name=crop]');
    const eBtnFailure = document.querySelector('button[name=cancel]');

    /* Reader object to preview image */
    let eFileReader = new FileReader();
    eFileReader.onload = function (e) {
      __funcDisplayModal('__modal-crop', 'flex', 'block');
      eCroppingImage.src = e.target.result;
      /* Set new cropper object */
      let eCropperPlugin = new Cropper(eCroppingImage, {
          aspectRatio: 1,
          viewMode: 3,
          responsive: true,
          zoomable: true,
          background: false,
          minCropBoxWidth: 40,
          minCropBoxHeight: 40
        },

        eBtnSuccess.onclick = function () {
          eCanvasCropper = eCropperPlugin.getCroppedCanvas({width: 200, height: 200});
          eUserAvatar.src = eCanvasCropper.toDataURL();
          __ajaxUploadImage(eCanvasCropper);
          __funcDisplayModal('__modal-crop', 'none', 'none');
          eCropperPlugin.destroy();
        },

        eBtnFailure.onclick = function () {
          __funcDisplayModal('__modal-crop', 'none', 'none');
          eCropperPlugin.destroy();
        },

        eBtnClose.onclick = function () {
          __funcDisplayModal('__modal-crop', 'none', 'none');
          eCropperPlugin.destroy();
        }
      );
    };

    eFileReader.readAsDataURL(dFile.files[0]);
  } else {
    return;
  }
}


/* Display cropper container */
function __funcDisplayAccordion(e) {
  let eEntireSearchContainer = e.nextElementSibling;
  if (eEntireSearchContainer.style.maxHeight === '400px' && eEntireSearchContainer.style.marginBottom === '2rem' && eEntireSearchContainer.style.overflow === 'visible') {
    eEntireSearchContainer.removeAttribute('style');
  } else {
    eEntireSearchContainer.style.maxHeight = '400px';
    eEntireSearchContainer.style.paddingTop = '1rem';
    eEntireSearchContainer.style.marginBottom = '2rem';

    setTimeout(() => {
      eEntireSearchContainer.style.overflow = 'visible';
    }, 600);
  }
}

function __funcSelectInput() {
  const eSelects = document.querySelectorAll('.__select-input');

  eSelects.forEach((eSelect, i) => {
    eSelect.addEventListener('click', function(e) {
      let eArrowIcon = this.childNodes[3];
      let ePlacerHolder = this.childNodes[1];
      let eDropdownContainer = this.nextElementSibling;
      let eInnerSelectorContent = this.querySelectorAll('small.__input-option');

      if (eInnerSelectorContent.length > 0 && eDropdownContainer.style.display === 'block') {
        eArrowIcon.classList.remove('__arrow-spin');
        eDropdownContainer.removeAttribute('style');
      } else if (ePlacerHolder.className === '__placer' && eArrowIcon.className === 'fas fa-caret-down' || ePlacerHolder.className === '__placer __placer-focus' && eArrowIcon.className === 'fas fa-caret-down') {
        eArrowIcon.classList.add('__arrow-spin');
        ePlacerHolder.classList.add('__placer-focus');
        eDropdownContainer.style.display = 'block';
      } else {
        eArrowIcon.classList.remove('__arrow-spin');
        ePlacerHolder.classList.remove('__placer-focus');
        eDropdownContainer.removeAttribute('style');
      }
    });
  });

  

  document.addEventListener('click', function(e) {
    let eNodeName = e.target.localName;
    let eClassName = e.target.className;
    let eTargetName = eNodeName + '.' + eClassName;

    let eDropdownContainers = document.querySelectorAll('.__select-dropdown');

    if (eTargetName !== 'div.__select-input' && eTargetName !== 'li.__dropdown-option' && eTargetName !== 'small.__input-option') {
      for (let i = 0; i < eDropdownContainers.length; i++) {
        let eArrowIcons = eDropdownContainers[i].previousElementSibling.querySelectorAll('.fas.fa-caret-down');
        let ePlacerHolders = eDropdownContainers[i].previousElementSibling.querySelectorAll('.__placer');
        let eInnerSelectorContents = eDropdownContainers[i].previousElementSibling.querySelectorAll('small.__input-option');

        if (eInnerSelectorContents.length > 0 && eDropdownContainers[i].style.display === 'block') {
          eArrowIcons[0].classList.remove('__arrow-spin');
          eDropdownContainers[i].removeAttribute('style');
        } else if (eInnerSelectorContents.length > 0 && !eDropdownContainers[i].hasAttribute('style')) {
          eArrowIcons[0].classList.remove('__arrow-spin');
        } else {
          eArrowIcons[0].classList.remove('__arrow-spin');
          ePlacerHolders[0].classList.remove('__placer-focus');
          eDropdownContainers[i].removeAttribute('style');
        }
      }
    }
  });
}

function __funcSelectOptions(e) {
  let eInnerText = e.childNodes[0].textContent;
  let eNewOption = document.createElement('small');
  let eSelectContainer = e.parentElement.parentElement.previousElementSibling;
  /* Create inside element in select area */
  eNewOption.setAttribute('class', '__input-option');
  eNewOption.setAttribute('onclick', '__funcSelectDelete(this)');
  eNewOption.innerHTML = eInnerText;
  eSelectContainer.appendChild(eNewOption);
  e.parentElement.parentElement.style.top = 'calc(' + eSelectContainer.offsetHeight + 'px + 1rem)';
  e.style.display = 'none';
}

function __funcSelectDelete(e) {
  let eSelectContent = e.parentElement;
  let eDropdownContent = eSelectContent.nextElementSibling.querySelectorAll('li');

  for (var i = 0; i < eDropdownContent.length; i++) {
    if (eDropdownContent[i].childNodes[0].textContent == e.childNodes[0].textContent) {
      eDropdownContent[i].removeAttribute('style');
      e.remove();
    }
  }
}

function __funcSelectSearch(e) {
  let dSearchText = e.childNodes[0].textContent;
  let eInputDropdown = e.parentElement.parentElement;
  let eInputSearch = e.parentElement.parentElement.previousElementSibling.previousElementSibling;

  eInputSearch.value = dSearchText;
  eInputDropdown.removeAttribute('style');
}

//__funcDisplayConfirmationModal('__modal-achievement', '__message', 'Are you sure?', '0', '1', __funcAchievementsCompletionCallback);
