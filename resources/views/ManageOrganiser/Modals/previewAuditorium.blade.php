<div role="dialog"  class="modal fade" style="display: none;">
    <div class="modal-dialog" style="width: 100%; height: 100%; margin: 0; padding: 0;">
        <div class="modal-content" style="height: auto; min-height: 100%; border-radius: 0;">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h3 class="modal-title">
                    <i class="ico-ticket"></i>
                    {{ $auditorium->name }}</h3>
            </div>
            <div class="modal-body">
                




                <div class="wrapper">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="stage">Stage</div>
                            <div id="seat-map"></div>

                            {{-- <div>
                                <h4 >
                                    Total Seats #: <span style="color: #676967;">{{ $auditorium->seats_no }}</span> <span>|</span>
                                    Rows #: <span style="color: #676967;">{{ $auditorium->rows_no }} </span> | 
                                    Columns #: <span style="color: #676967;">{{ $auditorium->columns_no }} </span> | 
                                    Public ?: <span style="color: #676967;">{{ $auditorium->is_public ? 'Yes' : 'No' }} </span>
                                </h4>
                            </div> --}}
                            
                        </div>
                    </div>
                </div><!-- /end seat wrapper-->






            </div> <!-- /end modal body-->

            <div class="modal-footer" style="position: fixed; bottom:0; width: 100%;">
               {!! Form::button('Cancel', ['class'=>"btn modal-close btn-danger",'data-dismiss'=>'modal']) !!}
            </div>
        </div><!-- /end modal content-->
    </div>
</div>

<script type="text/javascript">

    var thisSeat;

    $(document).ready(function() {
        var $cart = $('#selected-seats'),
            $counter = $('#counter'),
            $total = $('#total'),
            sc = $('#seat-map').seatCharts({
                seats: {!! $seats !!},
                map: {!! $map !!},
                naming : {
                    top : false,
                    left: true,
                    rows: {!! $rows !!},
                    getLabel : function (character, row, column) {
                        return '<i class="fa fa-circle"></i>';
                    },
                    getId  : function(character, row, column) {
                        return row + '_' + column;
                    }
                },
                legend : {
                    node : $('#legend'),
                    items : [
                        [ 'A', 'available',   'First Class' ],
                        [ 'B', 'available',   'Economy Class'],
                        [ 'C', 'unavailable', 'Already Booked']
                    ]
                },
                click: function () {
                    //console.log(this.settings);
                    if (this.status() == 'available') {
                        //let's create a new <li> which we'll add to the cart items
                        $('<li>'+this.data().category+' Seat # '+this.settings.id+': <b>$'+this.data().price+'</b> <a  class="cancel-cart-item">[cancel]</a></li>')
                            .attr('id', 'cart-item-'+this.settings.id)
                            .data('seatId', this.settings.id)
                            .appendTo($cart);

                        /*
                         * Lets update the counter and total
                         *
                         * .find function will not find the current seat, because it will change its stauts only after return
                         * 'selected'. This is why we have to add 1 to the length and the current seat price to the total.
                         */
                        $counter.text(sc.find('selected').length+1);
                        $total.text(recalculateTotal(sc)+this.data().price);

                        return 'selected';
                    } else if (this.status() == 'selected') {
                        //update the counter
                        $counter.text(sc.find('selected').length-1);
                        //and total
                        $total.text(recalculateTotal(sc)-this.data().price);

                        //remove the item from our cart
                        $('#cart-item-'+this.settings.id).remove();

                        //seat has been vacated
                        return 'available';
                    } else if (this.status() == 'unavailable') {
                        //seat has been already booked
                        return 'unavailable';
                    } else {
                        return this.style();
                    }
                }

            });

        //this will handle "[cancel]" link clicks
        $('#selected-seats').on('click', '.cancel-cart-item', function () {
            //let's just trigger Click event on the appropriate seat, so we don't have to repeat the logic here
            sc.get($(this).parents('li:first').data('seatId')).click();
        });

        //let's pretend some seats have already been booked
        sc.get(['A1', 'A6']).status('unavailable');

        // handle seat hover
        $('[data-toggle=popover]')
            .hover(function() {
                thisSeat = sc.get([this.id]).seats[0];
                $(this).popover('show');
            }, function(){
                $(this).popover('hide');
        }).on('click', function(){
            $(this).popover('hide');
        }).popover({
            content: function(){
                return '<div id="seat-popover-content">Seat# '+ thisSeat.settings.id +'<br>Category: '+ thisSeat.settings.data.category +'<br>Price: '+ thisSeat.settings.data.price +' </div>';
            },
            html: true,
            animation: false,
            placement: 'top'
        });

        $('#loading').hide();

    });

    function recalculateTotal(sc) {
        var total = 0;

        //basically find every selected seat and sum its price
        sc.find('selected').each(function () {
            total += this.data().price;
        });

        return total;
    }


</script>