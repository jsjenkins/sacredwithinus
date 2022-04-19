<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the wordpress construct of pages
 * and that other 'pages' on your wordpress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Boilerplate
 * @since Boilerplate 1.0
 */

get_header(); ?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			<div class="shoppost">
				<h1 class="page-title">Paintings</h1>
				<img src="https://sacredwithin.us/wp-content/uploads/2015/05/painting-image.jpg" />
				<p>To purchase one of Lisa's original paintings, please visit her gallery page to see prices and contact her to purchase.</p>
					<a class="contentmorebutton" href="/gallery/">Go to the Gallery</a>
			</div>
			<div class="shoppost">
				<h1 class="page-title">Journals</h1>
				<p>A self-guided journal experience for an individual, or as part of a group retreat.</p>
				<div class="journal-image">
					<img src="https://sacredwithin.us/wp-content/uploads/2015/05/journal-cover.jpg" />
				</div>
				<div class="journal-info">
					<h3>Journal Pricing</h3>

					<table>
					<thead>
					<tr>
					<th style="text-align:left;">
					Quantity
					</th>
					<th style="text-align:left;">
					Price
					</th>
					</tr>
					</thead>
					<tbody>
					<tr>
					<td>
					1-12
					</td>
					<td>
					$3.00 each
					</td>
					</tr>
					<tr>
					<td>
					13-24
					</td>
					<td>
					$2.75 each
					</td>
					</tr>
					<tr>
					<td>
					25-36
					</td>
					<td>
					$2.50 each
					</td>
					</tr>
					<tr>
					<td>
					37-49
					</td>
					<td>
					$2.25 each
					</td>
					</tr>
					<tr>
					<td>
					50+
					</td>
					<td>
					$2.00 each
					</td>
					</tr>
					</tbody>
					</table>
					<p><em>*free shipping in the US</em></p>
<script type="text/javascript">
<!--
var ac = 0;    // table for qty/amt pairs
var aqty = new Array ();  // qty brkpt
var aamt = new Array ();  // amount to charge

var pc = 0;    // table for qty/percent pairs
var pqty = new Array ();  // qty brkpt
var pper = new Array ();  // percent to discount

function Dollar (val) {  // force to valid dollar amount
var str,pos,rnd=0;
  if (val < .995) rnd = 1;  // for old Netscape browsers
  str = escape (val*1.0 + 0.005001 + rnd);  // float, round, escape
  pos = str.indexOf (".");
  if (pos > 0) str = str.substring (rnd, pos + 3);
  return str;
}

function ReadForm (obj1) { // quantity based discounts
var i,amt,des,qty;
  amt = obj1.baseamt.value*1.0; // base amount
  des = obj1.basedes.value;     // base description
  qty = obj1.qty.value;         // get user quantity
  if (isNaN (qty) || qty < 1) { // make sure it's good
    alert ('"' + qty + '"' + ' is not a valid number!');
    ac = 0;                     // always zap the table
    pc = 0;
    return false;               // th-th-that's all, folks.
  }
  qty = qty*1.0;                // force to numeric

  for (i=ac-1; i>=0; i=i-1) {   // run table backwards
    if (qty >= aqty[i]) {       // use this entry
      amt = aamt[i];            // this is the real amount
      break;                    // get out, we're done
    }
  }
  for (i=pc-1; i>=0; i=i-1) {   // run table backwards
    if (qty >= pqty[i]) {       // use this entry
      amt = amt - (amt/100.0 * pper[i]);
      break;                    // get out, we're done
    }
  }

  obj1.item_name.value = des + ", package of " + qty + " @" +
                         Dollar (amt) + " each.";
  obj1.amount.value = Dollar (amt * qty);
  ac = 0;  // reset item discount
  pc = 0;
}

function SetAmt (q1, a1) {  // set up a quantity-based amount table
var i;
  ac = 0;
  for (i=0; i<arguments.length; i=i+2) {  // build the table
    aqty[ac] = arguments[i];   // get real args and store 
    aamt[ac] = arguments[i+1];
    ac = ac + 1;               // number of pairs in table
  }
}

function SetPer (q1, p1) {  // set up a quantity-based percent table
var i;
  pc = 0;
  for (i=0; i<arguments.length; i=i+2) {  // build the table
    pqty[pc] = arguments[i];   // get real args and store 
    pper[pc] = arguments[i+1];
    pc = pc + 1;               // number of pairs in table
  }
}
//-->
</script>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" 
		onsubmit="this.target = 'paypal';
				  SetAmt (1, 3, 13, 2.75, 25, 2.5, 37, 2.25, 50, 2);
				  return ReadForm (this);">
		<p class="p1">
		<input type="hidden" name="cmd" value="_cart" />
		<input type="hidden" name="add" value="1" />
		<input type="hidden" name="business" value="BakerLisaB@gmail.com" />
		<input type="hidden" name="item_name" value="" />
		<input type="hidden" name="amount" value="" />
		<input type="hidden" name="currency_code" value="USD" />
		<input type="hidden" name="lc" value="US" />

		<input type="hidden" name="baseamt" value="3.00" />
		<input type="hidden" name="basedes" value="Journals" />

		<h3>Enter Quantity</h3>
		<p><input type="text" name="qty" size="3" value="1" style="float:left;" /> 
		<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_cart_SM.gif" name="submit" alt="cart add" style="margin-top:2px; margin-left: 10px; float:left;" />
		</p>
		</form>
				</div>
			</div>
			<div class="shoppost">
				<h1 class="page-title">Samaritan Woman Retreats</h1>
				<h3>Communing at the Well<br />
<em>A Samaritan Woman Retreat</em></h3>

 
 
<p>In the time between my own spiritual direction sessions, I often imagined Jesus as my Spiritual Director. What questions would He ask? How much silence would He allow? How would He prompt my wonder and awe?</p>
 
<p>To my surprise, a Spiritual Mentor invited me to go through a nine-week retreat with Jesus. Once a week, she facilitated a session, but throughout the week I sat with Jesus, in the story from John 4.</p>
 
<p>If you are curious about spiritual direction, this type of personal involvement offers exploration, without feeling the pressure of a long-term commitment. The weekly spiritual direction sessions provide a scriptural experience of Living Water. If this kind of connection intrigues you, I am available to travel with you, in person, by phone or Skype, to virtual Samaria. Together we will sit by the well with Jesus.</p>
 
<p>Each of the nine sessions is an hour and half to two hours in length. The fee is $50.00 per session. If I can answer any questions, feel free to email me: Lisa@SacredWithin.Us</p>

<a class="contentmorebutton" href="/about/">Contact Lisa about Upcoming Dates</a>
			</div>
			<div class="shoppost">
				<h1 class="page-title">Spiritual Direction</h1>
				<p>In a broad sense, Individual Spiritual Direction is a relationship between two persons, each seeking intimacy with God. The more seasoned “director” creates a sacred, listening space for the directee to talk through the things that are pertinent to his or her spiritual journey. The director occasionally asks non-leading questions that may assist the directee in simply being rather than striving to become. Together, they look at how God’s Spirit may be prompting or leading the session.</p>

<p>Spiritual Direction, at it’s best, is coming home to one’s truest, God created self to find a more embracing, compassionate heart.</p>

<p><em>For Spiritual Direction in person, by phone or Skype, contact Lisa using the form below or by email at <strong><a href="mailto:lisa@sacredwithin.us">lisa@SacredWithin.Us</a></strong>. Lisa's rate is $60.00/hour.</em></p>
<a class="contentmorebutton" href="/spiritual-direction/">Read more about Spiritual Direction and Sign Up</a>
			</div>
<?php endwhile; ?>
<?php get_footer(); ?>