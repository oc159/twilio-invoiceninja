# twilio-invoiceninja
A connector between Twilio Pay and Invoice Ninja
This has been created to bridge the gap left open by workplaces regarding PCI compliance. VoIP phone calls are in PCI DSS scope and organisations can use this script idea to outsource this workflow and reduce risk.

This workflow has not been approved by a PCI QSA. Use at your own risk.
If you are unsure, contact an authorised QUALIFIED SECURITY ASSESSOR who can evaluate your specific scenario.

Process Workflow -> 
  User Calls Twilio Pay -> Call Recieved by PHP application -> User enters the invoice Number -> API gets invoice dollar value using the    invoice number of an argument -> Twilio Pay asks for value defined within the invoice -> Twilio <Pay> sends credit card details to Stripe

Utilising Twilio <Pay>
  https://www.twilio.com/pay
  The legends here: https://github.com/TwilioDevEd/api-snippets/blob/master/twiml/voice/gather/gather-2/gather-2.5.x.php
  Founded the Twilio integration code used in this project.
