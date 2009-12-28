function validate_email(field,alerttxt)
{
  with (field)
  {
    apos=value.indexOf("@");
    dotpos=value.lastIndexOf(".");
    if (apos<1||dotpos-apos<2)
    {
      alert(alerttxt);
      return false;
    }
    else
    {
      return true;
    }
  }
}

function validate_required(field,alerttxt)
{
  with (field)
  {
    if (value==null||value=="")
    {
      alert(alerttxt);
      return false;
    }
    else
    {
      return true;
    }
  }
}

function validate_qty(field,alerttxt)
{
  with (field)
  {
    if (value==null||value==""||isNaN(value)||parseInt(value) < 0)
    {
      alert(alerttxt);
      return false;
    }
    else
    {
      return true;
    }
  }
}

function validate_total_qty(field1,field2,field3,alerttxt)
{

  if (parseInt(field1.value)+parseInt(field2.value)+parseInt(field3.value) < 1)
  {
    alert(alerttxt);
    return false;
  }
  else
  {
    return true;
  }
}

function validate_form(thisform)
{
  with (thisform)
  {
    /*
    if (validate_required(title,"Title must be filled in!")==false)
    {
      title.focus();
      return false;
    }
    if (validate_required(first_name,"First Name must be filled in!")==false)
    {
      first_name.focus();
      return false;
    }
    if (validate_required(last_name,"Last Name must be filled in!")==false)
    {
      last_name.focus();
      return false;
    }
    if (validate_required(address1,"Address 1 must be filled in!")==false)
    {
      address1.focus();
      return false;
    }
    if (validate_required(city,"City must be filled in!")==false)
    {
      city.focus();
      return false;
    }
    if (validate_required(post_code,"Post Code must be filled in!")==false)
    {
      post_code.focus();
      return false;
    }
    */
    if (validate_email(email_address,"Not a valid e-mail address!")==false)
    {
      email_address.focus();
      return false;
    }
    if (validate_qty(individuals_qty,"Please enter a valid quantity for Individual Tickets!")==false)
    {
      individuals_qty.focus();
      return false;
    }
    if (validate_qty(tables_qty,"Please enter a valid quantity for Tables!")==false)
    {
      tables_qty.focus();
      return false;
    }
    if (validate_qty(raffles_qty,"Please enter a valid quantity for Raffle Tickets!")==false)
    {
      raffles_qty.focus();
      return false;
    }
    if (validate_total_qty(individuals_qty,tables_qty,raffles_qty,"Total quantity should be greater than 0!")==false)
    {
      return false;
    }
    /*
    if (validate_required(guest_list,"Please provide a valid Guest List!")==false)
    {
      guest_list.focus();
      return false;
    }
	// babak/20091217: check guest list lines against total number of tickets    
    return CheckGuestList();    
    //<<
    */
  }
}


// babak/20091217: check guest list lines against total number of tickets
function CheckGuestList()
{
	guest_array = $('#guest_list').val().split("\n");
	guests = guest_array.length;
	tickets = $('#individuals_qty').val();
	tables = $('#tables_qty').val();
	total_tickets = parseInt(tables * 10) + parseInt(tickets);
	//alert(guests + ' ' + alltickets + ' tickets:' + tickets + ' tables:' + tables)
	if (guests != total_tickets)
	{
		alert('Please provide ' + total_tickets + ' names in total!');
		$('#guest_list').focus();
		return false;
	}
	for (i=0; i<total_tickets; i++)
	{
		guest_name = guest_array[i];
		if (guest_name == '')
		{
			alert('Please provide a valid name for guest number ' + (i+1) + '!');
			$('#guest_list').focus();
			return false;
			break;
		}	
	}
	return true;
}
//<<
