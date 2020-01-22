<?php
class MST_Onepagecheckout_Model_DeliveryTime
{
    public function toOptionArray()
    {
        $types = array(
                        '00:00'=>'00:00', 
                        '01:00'=>'01:00', 
                        '02:00'=>'02:00', 
                        '03:00'=>'03:00',
                        '04:00'=>'04:00',
                        '05:00'=>'05:00',
                        '06:00'=>'06:00',
                        '07:00'=>'07:00',
                        '08:00'=>'08:00',
                        '09:00'=>'09:00',
                        '10:00'=>'10:00',
                        '11:00'=>'11:00',
                        '12:00'=>'12:00',
                        '13:00'=>'13:00',
                        '14:00'=>'14:00',
                        '15:00'=>'15:00',
                        '16:00'=>'16:00',
                        '17:00'=>'17:00',
                        '18:00'=>'18:00',
                        '19:00'=>'19:00',
                        '20:00'=>'20:00',
                        '21:00'=>'21:00',
                        '22:00'=>'22:00',
                        '23:00'=>'23:00'
                    );
        $data = array();
        foreach($types as $key=>$value)	{
            $data[] = array('label' => $key, 'value' => strtolower($value));
        }
        return $data;
    }
}