function orderFormValidate(event) {
  if (event) event.preventDefault();

  var formObj = document.getElementById("orderForm");
  var total = 0;
  var summary = "";
  var taxRate = 0.07;

  var repairOptions = [["Consultation Appointment",50],["Last-Minute Repairs",75],["Antique Vinyl Restoration",150],
    ["Vinyl Resurfacing",120],["Player Player Repair",200],["Antique Record Player Repair",250],["Not Needed",0]
  ];

  var repairIndex = getSelectedIndex(document.getElementsByName("repairs"));
  if (repairIndex === -1) { alert("Please select a repair option."); return false; }
  if (repairIndex < repairOptions.length) {
    total += repairOptions[repairIndex][1];
    summary += repairOptions[repairIndex][0] + " - $" + repairOptions[repairIndex][1].toFixed(2) + "\n";
  }

  document.getElementsByName("care[]").forEach(function(checkbox) {
    if (checkbox.checked) {
      var qty = parseInt(document.querySelector("input[name='quantity[" + checkbox.value + "]']").value);
      if (isNaN(qty) || qty <= 0) { alert("Please enter a valid quantity for: " + checkbox.value); return false; }
      var itemTotal = parseFloat(checkbox.dataset.price) * qty;
      total += itemTotal;
      summary += checkbox.value + " x" + qty + " - $" + itemTotal.toFixed(2) + "\n";
    }
  });

  var shippingIndex = getSelectedIndex(document.getElementsByName("pickup_online"));
  if (shippingIndex === -1) { alert("Please select a shipping option."); return false; }
  if (shippingIndex === 1 && total < 75) { total += 20; summary += "Delivery Fee: $20.00\n"; }

  if (!formObj.tax_exempt.checked) {
    var tax = total * taxRate;
    total += tax;
    summary += "Sales Tax: $" + tax.toFixed(2) + "\n";
  }

  summary += "\nOrder Total: $" + total.toFixed(2);
  formObj.submit();
  return true;
}

function getSelectedIndex(radios) {
  for (var i = 0; i < radios.length; i++) { if (radios[i].checked) return i; }
  return -1;
}

window.onload = function() {
  document.getElementById("orderForm").addEventListener("submit", orderFormValidate);
};