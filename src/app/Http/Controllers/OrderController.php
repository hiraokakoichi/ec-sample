<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function addOrder(): View
    {
        $shortestDay = 3; // 要件1：最短配送日の設定 整数値。○日後を設定（設定値が「1」なら翌日から選択可能にする）
        $optionsNumber = 5; // 要件2：表示する選択肢の数の設定 整数値。（設定値が「5」なら5日分の選択肢を表示）
        $timeCloseMode = true; // 要件3：15時以降の注文の場合は、最短配送日を1日後にずらす設定 真偽値。（真なら有効、偽なら無効）
        $weekdayMode = true; // 要件4：土曜日、日曜日は配送不可日として、選択肢から除外する設定 真偽値。（真なら有効、偽なら無効）
        $prefecturesDay = config('prefectures_day')['福岡']; // 要件5: 配送先の都道府県によって、最短配送日を設定日数分、後にずらす設定 連想配列。（例: [‘北海道’ => 2, ‘沖縄県’ => 3]）

        Carbon::setLocale('ja');
        $now = Carbon::now();
        $firstDeliveryDate = $now->addDay($shortestDay); // 要件1

        if ($timeCloseMode && $now->hour >= 15) { // 要件3
            $firstDeliveryDate->addDay(1);
        }

        $firstDeliveryDate = $now->addDay($prefecturesDay); // 要件5

        $optionDateList = [];
        $count = 0;
        while ($count < $optionsNumber) { // 要件2
            if ($weekdayMode && $firstDeliveryDate->isWeekend()) { // 要件4
                $firstDeliveryDate->addDay(1);
                continue;
            }
            $optionDateList[] = [
                $firstDeliveryDate->toDateString(),
                $firstDeliveryDate->isoFormat('YYYY年MM月DD(ddd)')
            ];
            $firstDeliveryDate->addDay(1);
            $count++;
        }

        return view('order', [
            'optionDateList' => $optionDateList
        ]);
    }
}
