@extends('layouts.app')



@section('content')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Analytics
        </h2>
    </div>


        <!-- BEGIN: Sex Statistic -->
        <div class="intro-y px-5 pt-5 mt-5 box col-span-12">
            <div class="flex items-center px-5 py-5 sm:py-3 border-b border-slate-200/60 dark:border-darkmode-400">
                <h2 class="font-medium text-base mr-auto">
                    Sex Statistics
                </h2>
                <div class="dropdown ml-auto sm:hidden">
                    <a class="dropdown-toggle w-5 h-5 block" href="javascript:;" aria-expanded="false" data-tw-toggle="dropdown"> <i data-lucide="more-horizontal" class="w-5 h-5 text-slate-500"></i> </a>
                    <div class="dropdown-menu w-40">
                        <ul class="dropdown-content">
                            <li>
                                <a href="javascript:;" class="dropdown-item"> <i data-lucide="file" class="w-4 h-4 mr-2"></i> Download XML </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <button class="btn btn-outline-secondary hidden sm:flex"> <i data-lucide="file" class="w-4 h-4 mr-2"></i> Download XML </button>
            </div>
            <div class="grid grid-cols-1 2xl:grid-cols-7 gap-6 p-5">
                <div class="2xl:col-span-2">
                    <div class="grid grid-cols-2 gap-6">
                        <div class="col-span-2 sm:col-span-1 2xl:col-span-2 box dark:bg-darkmode-500 p-5">
                            <div class="font-medium">Male</div>
                            <div class="flex items-center mt-1 sm:mt-0">
                                <div class="mr-4 w-20 flex"> USP: <span class="ml-3 font-medium text-success">+23%</span> </div>
                                <div class="w-5/6 overflow-auto">
                                    <div class="h-[51px]">
                                        <canvas class="simple-line-chart-1-new" data-random="true"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-2 sm:col-span-1 2xl:col-span-2 box dark:bg-darkmode-500 p-5">
                            <div class="font-medium">Female</div>
                            <div class="flex items-center mt-1 sm:mt-0">
                                <div class="mr-4 w-20 flex"> USP: <span class="ml-3 font-medium text-danger">-5%</span> </div>
                                <div class="w-5/6 overflow-auto">
                                    <div class="h-[51px]">
                                        <canvas class="simple-line-chart-1" data-random="true"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-2 sm:col-span-1 2xl:col-span-2 box dark:bg-darkmode-500 p-5">
                            <div class="font-medium">N/A</div>
                            <div class="flex items-center mt-1 sm:mt-0">
                                <div class="mr-4 w-20 flex"> USP: <span class="ml-3 font-medium text-danger">-10%</span> </div>
                                <div class="w-5/6 overflow-auto">
                                    <div class="h-[51px]">
                                        <canvas class="simple-line-chart-1" data-random="true"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="2xl:col-span-5 w-full">
                    <div class="mt-8">
                        <div class="h-[420px]">
                            <div class="card rounded">
                                <div class="card-body py-3 px-3">
                                    {!! $gender_chart->container() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Sex Statistic -->

        <!-- BEGIN: Tribe Statistic -->
        <div class="intro-y px-5 pt-5 mt-5 box col-span-12">
            <div class="flex items-center px-5 py-5 sm:py-3 border-b border-slate-200/60 dark:border-darkmode-400">
                <h2 class="font-medium text-base mr-auto">
                    Tribe Statistics
                </h2>
                <div class="dropdown ml-auto sm:hidden">
                    <a class="dropdown-toggle w-5 h-5 block" href="javascript:;" aria-expanded="false" data-tw-toggle="dropdown"> <i data-lucide="more-horizontal" class="w-5 h-5 text-slate-500"></i> </a>
                    <div class="dropdown-menu w-40">
                        <ul class="dropdown-content">
                            <li>
                                <a href="javascript:;" class="dropdown-item"> <i data-lucide="file" class="w-4 h-4 mr-2"></i> Download XML </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <button class="btn btn-outline-secondary hidden sm:flex"> <i data-lucide="file" class="w-4 h-4 mr-2"></i> Download XML </button>
            </div>
            <div class="grid grid-cols-1 2xl:grid-cols-7 gap-6 p-5">
                <div class="2xl:col-span-2">
                    <div class="grid grid-cols-2 gap-6 overflow-x-auto scrollbar-hidden pb-10">
                        <div class="col-span-2 sm:col-span-1 2xl:col-span-2 box dark:bg-darkmode-500 p-5">
                            <div class="font-medium">Bisaya</div>
                            <div class="flex items-center mt-1 sm:mt-0">
                                <div class="mr-4 w-20 flex"> USP: <span class="ml-3 font-medium text-success">+23%</span> </div>
                                <div class="w-5/6 overflow-auto">
                                    <div class="h-[51px]">
                                        <canvas class="simple-line-chart-1-new" data-random="true"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-2 sm:col-span-1 2xl:col-span-2 box dark:bg-darkmode-500 p-5">
                            <div class="font-medium">Cebuano</div>
                            <div class="flex items-center mt-1 sm:mt-0">
                                <div class="mr-4 w-20 flex"> USP: <span class="ml-3 font-medium text-danger">-5%</span> </div>
                                <div class="w-5/6 overflow-auto">
                                    <div class="h-[51px]">
                                        <canvas class="simple-line-chart-1" data-random="true"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-2 sm:col-span-1 2xl:col-span-2 box dark:bg-darkmode-500 p-5">
                            <div class="font-medium">Maute</div>
                            <div class="flex items-center mt-1 sm:mt-0">
                                <div class="mr-4 w-20 flex"> USP: <span class="ml-3 font-medium text-danger">-10%</span> </div>
                                <div class="w-5/6 overflow-auto">
                                    <div class="h-[51px]">
                                        <canvas class="simple-line-chart-1" data-random="true"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-2 sm:col-span-1 2xl:col-span-2 box dark:bg-darkmode-500 p-5">
                            <div class="font-medium">Igorot</div>
                            <div class="flex items-center mt-1 sm:mt-0">
                                <div class="mr-4 w-20 flex"> USP: <span class="ml-3 font-medium text-success">+55%</span> </div>
                                <div class="w-5/6 overflow-auto">
                                    <div class="h-[51px]">
                                        <canvas class="simple-line-chart-1" data-random="true"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="2xl:col-span-5 w-full">
                    <div class="mt-8">
                        <div class="h-[420px]">
                            <div class="card rounded">
                                <div id="chart">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Tribe Statistic -->

        <!-- BEGIN: Address Statistic -->
        <div class="intro-y px-5 pt-5 mt-5 box col-span-12">
            <div class="flex items-center px-5 py-5 sm:py-3 border-b border-slate-200/60 dark:border-darkmode-400">
                <h2 class="font-medium text-base mr-auto">
                    Address Statistics
                </h2>
                <div class="dropdown ml-auto sm:hidden">
                    <a class="dropdown-toggle w-5 h-5 block" href="javascript:;" aria-expanded="false" data-tw-toggle="dropdown"> <i data-lucide="more-horizontal" class="w-5 h-5 text-slate-500"></i> </a>
                    <div class="dropdown-menu w-40">
                        <ul class="dropdown-content">
                            <li>
                                <a href="javascript:;" class="dropdown-item"> <i data-lucide="file" class="w-4 h-4 mr-2"></i> Download XML </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <button class="btn btn-outline-secondary hidden sm:flex"> <i data-lucide="file" class="w-4 h-4 mr-2"></i> Download XML </button>
            </div>
            <div class="grid grid-cols-1 2xl:grid-cols-7 gap-6 p-5">
                <div class="2xl:col-span-2">
                    <div class="grid grid-cols-2 gap-6">
                        <div class="col-span-2 sm:col-span-1 2xl:col-span-2 box dark:bg-darkmode-500 p-5">
                            <div class="font-medium">Net Worth</div>
                            <div class="flex items-center mt-1 sm:mt-0">
                                <div class="mr-4 w-20 flex"> USP: <span class="ml-3 font-medium text-success">+23%</span> </div>
                                <div class="w-5/6 overflow-auto">
                                    <div class="h-[51px]">
                                        <canvas class="simple-line-chart-1-new" data-random="true"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-2 sm:col-span-1 2xl:col-span-2 box dark:bg-darkmode-500 p-5">
                            <div class="font-medium">Sales</div>
                            <div class="flex items-center mt-1 sm:mt-0">
                                <div class="mr-4 w-20 flex"> USP: <span class="ml-3 font-medium text-danger">-5%</span> </div>
                                <div class="w-5/6 overflow-auto">
                                    <div class="h-[51px]">
                                        <canvas class="simple-line-chart-1" data-random="true"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-2 sm:col-span-1 2xl:col-span-2 box dark:bg-darkmode-500 p-5">
                            <div class="font-medium">Profit</div>
                            <div class="flex items-center mt-1 sm:mt-0">
                                <div class="mr-4 w-20 flex"> USP: <span class="ml-3 font-medium text-danger">-10%</span> </div>
                                <div class="w-5/6 overflow-auto">
                                    <div class="h-[51px]">
                                        <canvas class="simple-line-chart-1" data-random="true"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-2 sm:col-span-1 2xl:col-span-2 box dark:bg-darkmode-500 p-5">
                            <div class="font-medium">Products</div>
                            <div class="flex items-center mt-1 sm:mt-0">
                                <div class="mr-4 w-20 flex"> USP: <span class="ml-3 font-medium text-success">+55%</span> </div>
                                <div class="w-5/6 overflow-auto">
                                    <div class="h-[51px]">
                                        <canvas class="simple-line-chart-1" data-random="true"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="2xl:col-span-5 w-full">
                    <div class="mt-8">
                        <div class="h-[420px]">
                            <div class="card rounded">
                                <div id="apex-chart-line-column">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Address Statistic -->

        <!-- BEGIN: Leave Statistic -->
        <div class="intro-y px-5 pt-5 mt-5 box col-span-12">
            <div class="flex items-center px-5 py-5 sm:py-3 border-b border-slate-200/60 dark:border-darkmode-400">
                <h2 class="font-medium text-base mr-auto">
                    Leave Statistics
                </h2>
                <div class="dropdown ml-auto sm:hidden">
                    <a class="dropdown-toggle w-5 h-5 block" href="javascript:;" aria-expanded="false" data-tw-toggle="dropdown"> <i data-lucide="more-horizontal" class="w-5 h-5 text-slate-500"></i> </a>
                    <div class="dropdown-menu w-40">
                        <ul class="dropdown-content">
                            <li>
                                <a href="javascript:;" class="dropdown-item"> <i data-lucide="file" class="w-4 h-4 mr-2"></i> Download XML </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <button class="btn btn-outline-secondary hidden sm:flex"> <i data-lucide="file" class="w-4 h-4 mr-2"></i> Download XML </button>
            </div>
            <div class="grid grid-cols-1 2xl:grid-cols-7 gap-6 p-5">
                <div class="2xl:col-span-2">
                    <div class="grid grid-cols-2 gap-6">
                        <div class="col-span-2 sm:col-span-1 2xl:col-span-2 box dark:bg-darkmode-500 p-5">
                            <div class="font-medium">Net Worth</div>
                            <div class="flex items-center mt-1 sm:mt-0">
                                <div class="mr-4 w-20 flex"> USP: <span class="ml-3 font-medium text-success">+23%</span> </div>
                                <div class="w-5/6 overflow-auto">
                                    <div class="h-[51px]">
                                        <canvas class="simple-line-chart-1-new" data-random="true"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-2 sm:col-span-1 2xl:col-span-2 box dark:bg-darkmode-500 p-5">
                            <div class="font-medium">Sales</div>
                            <div class="flex items-center mt-1 sm:mt-0">
                                <div class="mr-4 w-20 flex"> USP: <span class="ml-3 font-medium text-danger">-5%</span> </div>
                                <div class="w-5/6 overflow-auto">
                                    <div class="h-[51px]">
                                        <canvas class="simple-line-chart-1" data-random="true"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-2 sm:col-span-1 2xl:col-span-2 box dark:bg-darkmode-500 p-5">
                            <div class="font-medium">Profit</div>
                            <div class="flex items-center mt-1 sm:mt-0">
                                <div class="mr-4 w-20 flex"> USP: <span class="ml-3 font-medium text-danger">-10%</span> </div>
                                <div class="w-5/6 overflow-auto">
                                    <div class="h-[51px]">
                                        <canvas class="simple-line-chart-1" data-random="true"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-2 sm:col-span-1 2xl:col-span-2 box dark:bg-darkmode-500 p-5">
                            <div class="font-medium">Products</div>
                            <div class="flex items-center mt-1 sm:mt-0">
                                <div class="mr-4 w-20 flex"> USP: <span class="ml-3 font-medium text-success">+55%</span> </div>
                                <div class="w-5/6 overflow-auto">
                                    <div class="h-[51px]">
                                        <canvas class="simple-line-chart-1" data-random="true"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="2xl:col-span-5 w-full">
                    <div class="mt-8">
                        <div class="h-[420px]">
                            <div class="card rounded">
                                <div id="chart3">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Leave Statistic -->

        <!-- BEGIN: SALN Statistic -->
        <div class="intro-y px-5 pt-5 mt-5 box col-span-12">
            <div class="flex items-center px-5 py-5 sm:py-3 border-b border-slate-200/60 dark:border-darkmode-400">
                <h2 class="font-medium text-base mr-auto">
                    SALN Statistics
                </h2>
                <div class="dropdown ml-auto sm:hidden">
                    <a class="dropdown-toggle w-5 h-5 block" href="javascript:;" aria-expanded="false" data-tw-toggle="dropdown"> <i data-lucide="more-horizontal" class="w-5 h-5 text-slate-500"></i> </a>
                    <div class="dropdown-menu w-40">
                        <ul class="dropdown-content">
                            <li>
                                <a href="javascript:;" class="dropdown-item"> <i data-lucide="file" class="w-4 h-4 mr-2"></i> Download XML </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <button class="btn btn-outline-secondary hidden sm:flex"> <i data-lucide="file" class="w-4 h-4 mr-2"></i> Download XML </button>
            </div>
            <div class="grid grid-cols-1 2xl:grid-cols-7 gap-6 p-5">
                <div class="2xl:col-span-2">
                    <div class="grid grid-cols-2 gap-6">
                        <div class="col-span-2 sm:col-span-1 2xl:col-span-2 box dark:bg-darkmode-500 p-5">
                            <div class="font-medium">Net Worth</div>
                            <div class="flex items-center mt-1 sm:mt-0">
                                <div class="mr-4 w-20 flex"> USP: <span class="ml-3 font-medium text-success">+23%</span> </div>
                                <div class="w-5/6 overflow-auto">
                                    <div class="h-[51px]">
                                        <canvas class="simple-line-chart-1-new" data-random="true"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-2 sm:col-span-1 2xl:col-span-2 box dark:bg-darkmode-500 p-5">
                            <div class="font-medium">Sales</div>
                            <div class="flex items-center mt-1 sm:mt-0">
                                <div class="mr-4 w-20 flex"> USP: <span class="ml-3 font-medium text-danger">-5%</span> </div>
                                <div class="w-5/6 overflow-auto">
                                    <div class="h-[51px]">
                                        <canvas class="simple-line-chart-1" data-random="true"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-2 sm:col-span-1 2xl:col-span-2 box dark:bg-darkmode-500 p-5">
                            <div class="font-medium">Profit</div>
                            <div class="flex items-center mt-1 sm:mt-0">
                                <div class="mr-4 w-20 flex"> USP: <span class="ml-3 font-medium text-danger">-10%</span> </div>
                                <div class="w-5/6 overflow-auto">
                                    <div class="h-[51px]">
                                        <canvas class="simple-line-chart-1" data-random="true"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-2 sm:col-span-1 2xl:col-span-2 box dark:bg-darkmode-500 p-5">
                            <div class="font-medium">Products</div>
                            <div class="flex items-center mt-1 sm:mt-0">
                                <div class="mr-4 w-20 flex"> USP: <span class="ml-3 font-medium text-success">+55%</span> </div>
                                <div class="w-5/6 overflow-auto">
                                    <div class="h-[51px]">
                                        <canvas class="simple-line-chart-1" data-random="true"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="2xl:col-span-5 w-full">
                    <div class="mt-8">
                        <div class="h-[420px]">
                            <div class="card rounded">
                                <div id="chart2">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: SALN Statistic -->

        <!-- BEGIN: DTR Statistic -->
        <div class="intro-y px-5 pt-5 mt-5 box col-span-12">
            <div class="flex items-center px-5 py-5 sm:py-3 border-b border-slate-200/60 dark:border-darkmode-400">
                <h2 class="font-medium text-base mr-auto">
                    DTR Statistics
                </h2>
                <div class="dropdown ml-auto sm:hidden">
                    <a class="dropdown-toggle w-5 h-5 block" href="javascript:;" aria-expanded="false" data-tw-toggle="dropdown"> <i data-lucide="more-horizontal" class="w-5 h-5 text-slate-500"></i> </a>
                    <div class="dropdown-menu w-40">
                        <ul class="dropdown-content">
                            <li>
                                <a href="javascript:;" class="dropdown-item"> <i data-lucide="file" class="w-4 h-4 mr-2"></i> Download XML </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <button class="btn btn-outline-secondary hidden sm:flex"> <i data-lucide="file" class="w-4 h-4 mr-2"></i> Download XML </button>
            </div>
            <div class="grid grid-cols-1 2xl:grid-cols-7 gap-6 p-5">
                <div class="2xl:col-span-2">
                    <div class="grid grid-cols-2 gap-6">
                        <div class="col-span-2 sm:col-span-1 2xl:col-span-2 box dark:bg-darkmode-500 p-5">
                            <div class="font-medium">Net Worth</div>
                            <div class="flex items-center mt-1 sm:mt-0">
                                <div class="mr-4 w-20 flex"> USP: <span class="ml-3 font-medium text-success">+23%</span> </div>
                                <div class="w-5/6 overflow-auto">
                                    <div class="h-[51px]">
                                        <canvas class="simple-line-chart-1-new" data-random="true"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-2 sm:col-span-1 2xl:col-span-2 box dark:bg-darkmode-500 p-5">
                            <div class="font-medium">Sales</div>
                            <div class="flex items-center mt-1 sm:mt-0">
                                <div class="mr-4 w-20 flex"> USP: <span class="ml-3 font-medium text-danger">-5%</span> </div>
                                <div class="w-5/6 overflow-auto">
                                    <div class="h-[51px]">
                                        <canvas class="simple-line-chart-1" data-random="true"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-2 sm:col-span-1 2xl:col-span-2 box dark:bg-darkmode-500 p-5">
                            <div class="font-medium">Profit</div>
                            <div class="flex items-center mt-1 sm:mt-0">
                                <div class="mr-4 w-20 flex"> USP: <span class="ml-3 font-medium text-danger">-10%</span> </div>
                                <div class="w-5/6 overflow-auto">
                                    <div class="h-[51px]">
                                        <canvas class="simple-line-chart-1" data-random="true"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-2 sm:col-span-1 2xl:col-span-2 box dark:bg-darkmode-500 p-5">
                            <div class="font-medium">Products</div>
                            <div class="flex items-center mt-1 sm:mt-0">
                                <div class="mr-4 w-20 flex"> USP: <span class="ml-3 font-medium text-success">+55%</span> </div>
                                <div class="w-5/6 overflow-auto">
                                    <div class="h-[51px]">
                                        <canvas class="simple-line-chart-1" data-random="true"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="2xl:col-span-5 w-full">
                    <div class="mt-8">
                        <div class="h-[420px]">
                            <div class="card rounded">
                                <div id="chart4">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: DTR Statistic -->

        <!-- BEGIN: DTR Statistic -->
        <div class="intro-y px-5 pt-5 mt-5 box col-span-12">
            <div class="flex items-center px-5 py-5 sm:py-3 border-b border-slate-200/60 dark:border-darkmode-400">
                <h2 class="font-medium text-base mr-auto">
                    DTR Statistics
                </h2>
                <div class="dropdown ml-auto sm:hidden">
                    <a class="dropdown-toggle w-5 h-5 block" href="javascript:;" aria-expanded="false" data-tw-toggle="dropdown"> <i data-lucide="more-horizontal" class="w-5 h-5 text-slate-500"></i> </a>
                    <div class="dropdown-menu w-40">
                        <ul class="dropdown-content">
                            <li>
                                <a href="javascript:;" class="dropdown-item"> <i data-lucide="file" class="w-4 h-4 mr-2"></i> Download XML </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <button class="btn btn-outline-secondary hidden sm:flex"> <i data-lucide="file" class="w-4 h-4 mr-2"></i> Download XML </button>
            </div>
            <div class="grid grid-cols-1 2xl:grid-cols-7 gap-6 p-5">
                <div class="2xl:col-span-2">
                    <div class="grid grid-cols-2 gap-6">
                        <div class="col-span-2 sm:col-span-1 2xl:col-span-2 box dark:bg-darkmode-500 p-5">
                            <div class="font-medium">Net Worth</div>
                            <div class="flex items-center mt-1 sm:mt-0">
                                <div class="mr-4 w-20 flex"> USP: <span class="ml-3 font-medium text-success">+23%</span> </div>
                                <div class="w-5/6 overflow-auto">
                                    <div class="h-[51px]">
                                        <canvas class="simple-line-chart-1-new" data-random="true"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-2 sm:col-span-1 2xl:col-span-2 box dark:bg-darkmode-500 p-5">
                            <div class="font-medium">Sales</div>
                            <div class="flex items-center mt-1 sm:mt-0">
                                <div class="mr-4 w-20 flex"> USP: <span class="ml-3 font-medium text-danger">-5%</span> </div>
                                <div class="w-5/6 overflow-auto">
                                    <div class="h-[51px]">
                                        <canvas class="simple-line-chart-1" data-random="true"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-2 sm:col-span-1 2xl:col-span-2 box dark:bg-darkmode-500 p-5">
                            <div class="font-medium">Profit</div>
                            <div class="flex items-center mt-1 sm:mt-0">
                                <div class="mr-4 w-20 flex"> USP: <span class="ml-3 font-medium text-danger">-10%</span> </div>
                                <div class="w-5/6 overflow-auto">
                                    <div class="h-[51px]">
                                        <canvas class="simple-line-chart-1" data-random="true"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-2 sm:col-span-1 2xl:col-span-2 box dark:bg-darkmode-500 p-5">
                            <div class="font-medium">Products</div>
                            <div class="flex items-center mt-1 sm:mt-0">
                                <div class="mr-4 w-20 flex"> USP: <span class="ml-3 font-medium text-success">+55%</span> </div>
                                <div class="w-5/6 overflow-auto">
                                    <div class="h-[51px]">
                                        <canvas class="simple-line-chart-1" data-random="true"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="2xl:col-span-5 w-full">
                    <div class="mt-8">
                        <div class="h-[420px]">
                            <div class="card rounded">
                                <div id="chart5">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: DTR Statistic -->

        <!-- BEGIN: Employee Statistic -->
        <div class="intro-y px-5 pt-5 mt-5 box col-span-12">
            <div class="flex items-center px-5 py-5 sm:py-3 border-b border-slate-200/60 dark:border-darkmode-400">
                <h2 class="font-medium text-base mr-auto">
                    Employee Statistics
                </h2>
                <div class="dropdown ml-auto sm:hidden">
                    <a class="dropdown-toggle w-5 h-5 block" href="javascript:;" aria-expanded="false" data-tw-toggle="dropdown"> <i data-lucide="more-horizontal" class="w-5 h-5 text-slate-500"></i> </a>
                    <div class="dropdown-menu w-40">
                        <ul class="dropdown-content">
                            <li>
                                <a href="javascript:;" class="dropdown-item"> <i data-lucide="file" class="w-4 h-4 mr-2"></i> Download XML </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <button class="btn btn-outline-secondary hidden sm:flex"> <i data-lucide="file" class="w-4 h-4 mr-2"></i> Download XML </button>
            </div>
            <div class="grid grid-cols-1 2xl:grid-cols-7 gap-6 p-5">
                <div class="2xl:col-span-2">
                    <div class="grid grid-cols-2 gap-6">
                        <div class="col-span-2 sm:col-span-1 2xl:col-span-2 box dark:bg-darkmode-500 p-5">
                            <div class="font-medium">Net Worth</div>
                            <div class="flex items-center mt-1 sm:mt-0">
                                <div class="mr-4 w-20 flex"> USP: <span class="ml-3 font-medium text-success">+23%</span> </div>
                                <div class="w-5/6 overflow-auto">
                                    <div class="h-[51px]">
                                        <canvas class="simple-line-chart-1-new" data-random="true"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-2 sm:col-span-1 2xl:col-span-2 box dark:bg-darkmode-500 p-5">
                            <div class="font-medium">Sales</div>
                            <div class="flex items-center mt-1 sm:mt-0">
                                <div class="mr-4 w-20 flex"> USP: <span class="ml-3 font-medium text-danger">-5%</span> </div>
                                <div class="w-5/6 overflow-auto">
                                    <div class="h-[51px]">
                                        <canvas class="simple-line-chart-1" data-random="true"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-2 sm:col-span-1 2xl:col-span-2 box dark:bg-darkmode-500 p-5">
                            <div class="font-medium">Profit</div>
                            <div class="flex items-center mt-1 sm:mt-0">
                                <div class="mr-4 w-20 flex"> USP: <span class="ml-3 font-medium text-danger">-10%</span> </div>
                                <div class="w-5/6 overflow-auto">
                                    <div class="h-[51px]">
                                        <canvas class="simple-line-chart-1" data-random="true"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-2 sm:col-span-1 2xl:col-span-2 box dark:bg-darkmode-500 p-5">
                            <div class="font-medium">Products</div>
                            <div class="flex items-center mt-1 sm:mt-0">
                                <div class="mr-4 w-20 flex"> USP: <span class="ml-3 font-medium text-success">+55%</span> </div>
                                <div class="w-5/6 overflow-auto">
                                    <div class="h-[51px]">
                                        <canvas class="simple-line-chart-1" data-random="true"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="2xl:col-span-5 w-full">
                    <div class="mt-8">
                        <div class="h-[420px]">
                            <div class="card rounded">
                                <div id="chart6">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Employee Statistic -->

        <!-- BEGIN: Travel Order Statistic -->
        <div class="intro-y px-5 pt-5 mt-5 box col-span-12">
            <div class="flex items-center px-5 py-5 sm:py-3 border-b border-slate-200/60 dark:border-darkmode-400">
                <h2 class="font-medium text-base mr-auto">
                    Travel Order Statistics
                </h2>
                <div class="dropdown ml-auto sm:hidden">
                    <a class="dropdown-toggle w-5 h-5 block" href="javascript:;" aria-expanded="false" data-tw-toggle="dropdown"> <i data-lucide="more-horizontal" class="w-5 h-5 text-slate-500"></i> </a>
                    <div class="dropdown-menu w-40">
                        <ul class="dropdown-content">
                            <li>
                                <a href="javascript:;" class="dropdown-item"> <i data-lucide="file" class="w-4 h-4 mr-2"></i> Download XML </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <button class="btn btn-outline-secondary hidden sm:flex"> <i data-lucide="file" class="w-4 h-4 mr-2"></i> Download XML </button>
            </div>
            <div class="grid grid-cols-1 2xl:grid-cols-7 gap-6 p-5">
                <div class="2xl:col-span-2 " >
                    <div class="grid grid-cols-2 gap-6">
                        <div class="col-span-2 sm:col-span-1 2xl:col-span-2 box dark:bg-darkmode-500 p-5">
                            <div class="font-medium">Net Worth</div>
                            <div class="flex items-center mt-1 sm:mt-0">
                                <div class="mr-4 w-20 flex"> USP: <span class="ml-3 font-medium text-success">+23%</span> </div>
                                <div class="w-5/6 overflow-auto">
                                    <div class="h-[51px]">
                                        <canvas class="simple-line-chart-1-new" data-random="true"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-2 sm:col-span-1 2xl:col-span-2 box dark:bg-darkmode-500 p-5">
                            <div class="font-medium">Sales</div>
                            <div class="flex items-center mt-1 sm:mt-0">
                                <div class="mr-4 w-20 flex"> USP: <span class="ml-3 font-medium text-danger">-5%</span> </div>
                                <div class="w-5/6 overflow-auto">
                                    <div class="h-[51px]">
                                        <canvas class="simple-line-chart-1" data-random="true"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-2 sm:col-span-1 2xl:col-span-2 box dark:bg-darkmode-500 p-5">
                            <div class="font-medium">Profit</div>
                            <div class="flex items-center mt-1 sm:mt-0">
                                <div class="mr-4 w-20 flex"> USP: <span class="ml-3 font-medium text-danger">-10%</span> </div>
                                <div class="w-5/6 overflow-auto">
                                    <div class="h-[51px]">
                                        <canvas class="simple-line-chart-1" data-random="true"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-2 sm:col-span-1 2xl:col-span-2 box dark:bg-darkmode-500 p-5">
                            <div class="font-medium">Products</div>
                            <div class="flex items-center mt-1 sm:mt-0">
                                <div class="mr-4 w-20 flex"> USP: <span class="ml-3 font-medium text-success">+55%</span> </div>
                                <div class="w-5/6 overflow-auto">
                                    <div class="h-[51px]">
                                        <canvas class="simple-line-chart-1" data-random="true"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="2xl:col-span-5 w-full">
                    <div class="mt-8">
                        <div class="h-[420px]">
                            <div class="card rounded">
                                <div id="chart7">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Travel Order Statistic -->


    @if($gender_chart)
    {!! $gender_chart->script() !!}
    @endif
@endsection
@section('scripts')
<script src="{{ asset('/js/analytics/analytix.js') }}"></script>
@endsection

