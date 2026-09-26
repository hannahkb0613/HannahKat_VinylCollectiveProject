function feedbackValidate()
    {
      var formObj = document.getElementById("feedbackForm");
      var firstName = formObj.firstName.value;
      var lastName = formObj.lastName.value;
      var email = formObj.email.value;
      var comments1 = formObj.comments1.value;
      var comments2 = formObj.comments2.value;
      var everythingOK = true;

      if (!validateName(firstName))
      { alert("Please enter your first name."); everythingOK = false; }

      if (!validateName(lastName))
      { alert("Please enter your last name."); everythingOK = false; }

      if (!validateEmail(email))
      { alert("Please enter your email address."); everythingOK = false; }

      if (!atLeastOneChecked("purchased[]"))
      { alert("Please select at least one vinyl product purchased."); everythingOK = false; }

      if (!atLeastOneChecked("accessories[]"))
      { alert("Please select at least one repair service."); everythingOK = false; }

      if (!atLeastOneChecked("satisfaction1"))
      { alert("Please rate your product satisfaction."); everythingOK = false; }

      if (!atLeastOneChecked("satisfaction2"))
      { alert("Please rate your service satisfaction."); everythingOK = false; }

      if (!validateComments(comments1))
      { alert("Please enter comments for products."); everythingOK = false; }

      if (!validateComments(comments2))
      { alert("Please enter comments for services."); everythingOK = false; }

      if (everythingOK) return true;  else return false;
    }

    function validateName(name)
    { var p = name.search(/^[-'\w\s]+$/);
      if (p == 0) return true;  else return false;
    }

    function validateEmail(address)
    { var p = address.search(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})$/);
      if (p == 0) return true;  else return false;
    }

    function validateComments(text)
    { if (text != "") return true;  else return false;
    }

    function atLeastOneChecked(name)
    { var items = document.getElementsByName(name);
      for (var i = 0; i < items.length; i++)
      { if (items[i].checked) return true; }  
      return false;
    }