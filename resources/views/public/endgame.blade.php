<x-guest-layout>
    <div class="bg-gray-100 min-h-screen py-6 flex flex-col justify-center sm:py-12">
        <div class="relative py-3 sm:max-w-xl sm:mx-auto lg:min-w-[500px]">
            <div class="relative px-4 py-10 bg-white mx-8 md:mx-0 shadow rounded-3xl sm:p-10">
                <div class="max-w-md mx-auto">
                    <div class="flex items-center space-x-5">
                        <div class="block pl-2 font-semibold text-xl self-start text-gray-700">
                            <h2 class="leading-relaxed">Kraj YugoAuta</h2>
                        </div>
                    </div>
                    <div class="divide-y divide-gray-200">
                        <div class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
                            Ljudi moji ovo je kraj YugoAuta. Nije dugo trajalo ali je bilo zabavno. Često se male ribe
                            poput mene ne mogu boriti protiv velikih korporacija kao što je BlaBlaCar.
                            <br><br>
                            Imao sam najbolje namjere, ali bez velikog budžeta za marketing ovo neće voditi nigdje.
                            Ljudi
                            će i dalje koristiti Facebook grupe i BlaBlaCar. To je sasvim ok. Statistika na YugoAuto je
                            poprilično loša i ljudi jako malo koriste YugoAuto.
                            <br><br>
                            S toga sam odlučio ugasiti YugoAuto. Bit će ljudima ok i ako budu trebali platiti naknadu za
                            rezervaciju. Meni je bilo super, naučio sam puno i drago mi je što sam ponudio nešto
                            besplatno.
                            <br><br>
                            Pusa svima ;)
                            <br><br>
                            <b>Statistika</b>
                            <ul class="p-6">
                                <li>Ukupno prijevoza objavljeno: {{$stats['totalRides']}}</li>
                                <li>Ukupno poslanih zahtjeva za prijevoz: {{$stats['totalRideRequests']}}
                                    ({{$stats['totalRideRequestsPercentage']}}%)
                                </li>
                                <li>Ukupno prijevoza prihvaćeno: {{$stats['totalAccepted']}}
                                    ({{$stats['totalAcceptedPercentage']}}%)
                                </li>
                                <li>Datum zadnjeg zahtjeva za prijevoz: {{$stats['lastRideRequestDate']}}</li>
                                <li>Datum prvog prijevoza ikad objavljenog: {{$stats['firstRideDate']}}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
