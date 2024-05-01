@extends('layouts.master')
@section('title')
    {{ __('Instructions') }}
@endsection
@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-12">
                        <h3>{{ __('Instructions') }}</h3>
                    </div>
                </div>
            </div>
            <!-- Content Section -->
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-4">
                        <h5>About Graduation Projects</h5>
                        <p>Provide information about the importance of graduation projects, their objectives,
                            and guidelines. This section could include details on how graduation projects contribute to academic and professional development,
                            the expectations for project scope and quality, and examples of successful projects from previous years.</p>
                    </div>
                    <div class="mb-12">
                        <h5>Registration Process</h5>
                        <p>Explain the steps students need to follow to register their graduation projects.
                            This section could outline the required paperwork, deadlines for submission,
                            and any administrative procedures that students must complete.
                            It might also include tips for selecting a suitable project topic and finding a supervisor.</p>
                    </div>
                    <!-- Add more sections as needed -->
                </div>

                <div class="col-md-12">
                    <div class="mb-4">
                        <h5>College Regulations</h5>
                        <p>Download the college regulations PDF:</p>
                        <large>Old College Regulations</large>
                        <hr>
                        <a href="{{ asset('assets\download\لايحة قديمه.pdf') }}" class="btn btn-primary" download>Download PDF</a>
                        <hr>
                        <large>New College Regulations</large>
                        <hr>
                        <a href="{{ asset('assets\download\لايحة جديده.pdf') }}" class="btn btn-primary" download>Download PDF</a>
                        <hr>
                        <p>Ensure you are familiar with the college regulations governing graduation projects.
                            These regulations cover important aspects such as project requirements,
                            evaluation criteria, and academic integrity standards.</p>
                    </div>

                    <div class="mb-12">
                        <h5>Deadline Reminders</h5>
                        <p>Set reminders for important deadlines. Students can use this feature to receive notifications
                             about upcoming deadlines for project milestones,
                             paperwork submissions, and supervisor meetings.
                              Integration with calendar apps and email notifications can enhance the usability of this feature.</p>
                    </div>

                    <div class="mb-12">
                        <h5>Progress Tracking</h5>
                        <p>Track the progress of your project and receive feedback.
                             This feature enables students to monitor their project's development over time,
                              review feedback from supervisors, and identify areas for improvement.
                               Visualizations such as Gantt charts or progress bars can provide a clear overview of project status.</p>
                    </div>

                    <div class="mb-12">
                        <h5>Communication Platform</h5>
                        <p>Communicate with supervisors or coordinators. Students can use this platform to ask questions,
                             request guidance, and share updates on their project progress.
                            Features such as messaging, file sharing,
                             and discussion forums facilitate efficient communication between students and faculty members,
                            and you can contact College using this E-mail <a href="mailto:cidean@du.edu.eg">cidean@du.edu.eg</a>.</p>

                    </div>

                    <div class="mb-12">
                        <h5>Resource Library</h5>
                        <p>Access templates and guidelines for writing project proposals, reports, etc. The resource library provides students with valuable resources to support their project work, including sample documents, writing guides, and formatting templates. Categorizing resources by topic or format improves navigation and usability.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
