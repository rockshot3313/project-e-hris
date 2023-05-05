@extends('layouts.app')

@section('breadcrumb')
    {{ Breadcrumbs::render('My Documents') }}
@endsection

@section('content')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            My Documents
        </h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <button id="create_documents" class="btn btn-primary shadow-md mr-2" href="javascript:;" data-tw-toggle="modal" data-tw-target="#create_document">Create Documents</button>
        </div>
    </div>
    <div class="intro-y box p-5 mt-5">
        <div class="overflow-x-auto scrollbar-hidden pb-10">
            <table id="dt__createdDocs" class="table table-report -mt-2 table-hover">
                <thead>
                <tr>
                    <th style="display: none" class="text-center whitespace-nowrap ">#ID</th>
                    <th class="text-center whitespace-nowrap ">Code</th>
                    <th class="text-center whitespace-nowrap ">Title</th>
                    <th class="text-center whitespace-nowrap ">Description</th>
                    <th class="text-center whitespace-nowrap ">Type/Level</th>
                    <th class="text-center whitespace-nowrap ">Status</th>
                    <th class="text-center whitespace-nowrap ">Attachments</th>
                    <th class="text-center whitespace-nowrap ">Action</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
    @include('Documents.Modals.create_Docs')
    @include('Documents.Modals.update_Docs')
    @include('Documents.Modals.send_Docs')
    @include('Documents.Modals.receive.receive_attachments')
@endsection
@section('scripts')
    <script src="{{ asset('/js/my_Documents.js') }}"></script>
    <script src="{{ asset('/js/document_swal.js') }}"></script>
    <script src="{{ asset(('/js/forward_document.js')) }}"></script>
    {{--    <script src="{{ asset(('/js/track.js')) }}"></script>--}}
    <script src="{{ asset(('/js/filePond_upload.js')) }}"></script>
    <script src="{{ asset(('/js/add_document_attachments.js')) }}"></script>
    <script src="{{ asset(('/js/load_qr_details.js')) }}"></script>
@endsection

