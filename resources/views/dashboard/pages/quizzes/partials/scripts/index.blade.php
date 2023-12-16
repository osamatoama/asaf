<script>
    let columns = [
        { data: 'id', name: 'id', class: 'text-center' },
        { data: 'title', name: 'title', orderable: false, class: 'text-center' },
        { data: 'questions_count', name: 'questions_count', searchable: false, class: 'text-center' },
        { data: 'results_count', name: 'results_count', searchable: false, class: 'text-center' },
        { data: 'actions', name: 'actions', searchable: false, orderable: false, class: 'text-center' },
    ];

    let datatable = initDatatable('#quizzes-table', columns);
</script>
