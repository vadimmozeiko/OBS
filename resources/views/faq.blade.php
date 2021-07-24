@extends('layouts.app')

@section('content')
    <div class="container">
    <div id="accordion">
        <div class="card">
            <div class="card-header p-0" id="headingOne">
                <h5 class="mb-0">
                    <button class="btn btn-link text-white" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Do you deliver and set up?
                    </button>
                </h5>
            </div>

            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                    Absolutely! ASTRO JUMP’s™ Courteous drivers will deliver and set up each ASTRO JUMP™ and ensure that it is clean and in good working condition before your scheduled event time starts and come back to take it down after the party is over. Set up normally takes about 10-15 minutes per unit, and take down is about 15-20 minutes per unit. This service is included in your rental cost. Mileage rates apply on rentals outside of Calgary city limits. Scheduled delivery and pick up hours are 9am-9pm. Outdoor rentals will be picked up 30min prior to sunset if it occurs before 9pm.
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header p-0" id="headingTwo">
                <h5 class="mb-0">
                    <button class="btn btn-link collapsed text-white" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        What kind of power is required?
                    </button>
                </h5>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                <div class="card-body">
                    ASTRO JUMPS™ plug into a standard 110 household outlet. Each blower uses 8-12 amps so a dedicated 15 amp circuit is required for each blower. We will supply the cord, and we ask that nothing else be plugged into the outlet/circuit we are utilizing. Placement of the ASTRO JUMP™ should be no more than 80ft from that outlet. If you would like to set up an ASTRO JUMP™ at a park or place without an electrical outlet within 80 ft, let us know and we can arrange to use a generator for an additional charge.
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header p-0" id="headingThree">
                <h5 class="mb-0">
                    <button class="btn btn-link collapsed text-white" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        What surface can ASTRO JUMPS™ be set up on?
                    </button>
                </h5>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                <div class="card-body">
                    Our ASTRO JUMPS™ can be set up on grass, asphalt or indoor surfaces. For grass set ups we use 18″ spikes at each anchoring point, typically the four corners of a unit. Astro Jump needs to be notified of any irrigation lines, sprinklers, septic etc. in the ground before set up takes place. Asphalt set ups require tarps and sand/water bags for anchoring at an additional cost or a solid structure (trees etc.) to tie onto. We cannot set up on dirt, woodchip, unsodded lawns or gravel surfaces.
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header p-0" id="headingFour">
                <h5 class="mb-0">
                    <button class="btn btn-link collapsed text-white" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        How much room do I need to set up an ASTRO JUMP™?
                    </button>
                </h5>
            </div>
            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                <div class="card-body">
                    All of our units are different shapes and sizes. Unit dimensions can be found on each specific product page. Clearance of 3-4 feet around those dimensions will be required when the units are fully inflated.  The equipment can not be touching any walls, fences, trees, etc.
                    A standard gate with an entry point of 36″ is required for majority of our Bounce Houses and Combo units designed for backyards.  Most Obstacle Courses and Super Slides require and entry point of at least 48″. For access to the set up location, Astro Jump will need to be notified if there are any stairs, excessive gravel, excessive dirt,  narrow passages, rock or other potential hazards. Please call us with any questions regarding access to or space of the set up location
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header p-0" id="headingFive">
                <h5 class="mb-0">
                    <button class="btn btn-link collapsed text-white" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                        Are ASTRO JUMPS™ safe?
                    </button>
                </h5>
            </div>
            <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
                <div class="card-body">
                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header p-0" id="headingSix">
                <h5 class="mb-0">
                    <button class="btn btn-link collapsed text-white" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                        Are you Insured?
                    </button>
                </h5>
            </div>
            <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordion">
                <div class="card-body">
                    Yes. We carry $2 million liability insurance which covers the units, the blower and the setup. Please note: All individuals and companies that rent an ASTRO JUMP™ are required to sign a liability waiver prior to set up, contact your local office for a copy if needed. We CANNOT set up an ASTRO JUMP™ until the liability waiver is signed.
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header p-0" id="headingSeven">
                <h5 class="mb-0">
                    <button class="btn btn-link collapsed text-white" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                        Is there a deposit required to reserve an ASTRO JUMP™?
                    </button>
                </h5>
            </div>
            <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordion">
                <div class="card-body">
                    A 25% deposit is due at the time of booking for rentals under $1000 or 50% for rentals of $1000 or more. The remaining balance is due on delivery. Both are payable by cash, cheque, Credit Card, or email transfer to info@astrojump.ca.  Payments can be made online at astrojump.ca/payment. Deposits on rentals under $1000 are fully refundable if we are not able to setup due to the weather, or if cancellation is made 14 calendar days prior to the event. Deposits on rentals of $1000 or more are refundable if cancellation is made 60 calendar days prior to the event.
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header p-0" id="headingEight">
                <h5 class="mb-0">
                    <button class="btn btn-link collapsed text-white" data-toggle="collapse" data-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                        Can I have my party at a park?
                    </button>
                </h5>
            </div>
            <div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-parent="#accordion">
                <div class="card-body">
                    Yes. ASTRO JUMPS™ are great for parks. You may require a permit with the city in order to have an ASTRO JUMP™ at the park. Also check to see if electricity will be available, if not we can arrange for a generator for an additional charge.
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header p-0" id="headingNine">
                <h5 class="mb-0">
                    <button class="btn btn-link collapsed text-white" data-toggle="collapse" data-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                        How do I reserve my ASTRO JUMP™?
                    </button>
                </h5>
            </div>
            <div id="collapseNine" class="collapse" aria-labelledby="headingNine" data-parent="#accordion">
                <div class="card-body">
                    Simple! Just call the local number  or email and one of our friendly “Inflatable Specialists” will reserve your unit and gladly answer any questions you might have.                 </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header p-0" id="headingTen">
                <h5 class="mb-0">
                    <button class="btn btn-link collapsed text-white" data-toggle="collapse" data-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                        What if I have to cancel? What if the weather is bad?
                    </button>
                </h5>
            </div>
            <div id="collapseTen" class="collapse" aria-labelledby="headingTen" data-parent="#accordion">
                <div class="card-body">
                    Deposits are fully refundable if we are not able to setup due to the weather, or if a cancellation is made 14 calendar days prior to the event.
                    We can not set up in rain, snow, sub zero temperatures or winds over 30km/hr.  We are flexible and can make a “game day decision” when it comes to the weather. Astro Jump will make any decisions in regards to the weather on the day of your rental. Absolutely no refunds will be given once the equipment has been delivered and set up due to weather or non-use of the equipment.                 </div>
            </div>
        </div>
    </div>
    </div>
@endsection
