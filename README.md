# twilio-invoiceninja
A connector between Twilio Pay and Invoice Ninja
This has been created to bridge the gap left open by workplaces regarding PCI compliance. VoIP phone calls are in PCI DSS scope and organisations can use this script idea to outsource this workflow and reduce risk.

# this workflow has not been approved by a PCI Auditor, Use at your own risk, if you are unsure contact an authorised QUALIFIED SECURITY ASSESSOR

Process Workflow -> 
  User Calls Twilio Pay -> Call Recieved by PHP application -> User enters the invoice Number -> API gets invoice dollar value using the    invoice number of an argument -> Twilio Pay asks for value defined within the invoice -> Twilio <Pay> sends credit card details to Stripe

Utilising Twilio <Pay>
  https://www.twilio.com/pay
 We are collecting an invoice from Invoice Ninja, extracting the monetary value and passing it to the Twilio <Pay> application.
 This allows the Twilio <Pay> application to charge the correct dollar value for any customer 
