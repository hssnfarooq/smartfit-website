@if (App\Http\Controllers\PageDisplayController::odrzavanjeCheck())
    <div class="odrzavanje" style="padding: 100px; background:#a6dcda; position:fixed; z-index:9999; width: 100%; height: 100%; text-align:center; display: flex;justify-content: center;  align-items: center;">
        <!--
        <h3>Website Under Maintenance</h3>

        <p>We are currently performing scheduled maintenance.<br>
        We'll be back shortly. Thank you for your patience!</p>
        -->
        <img src="/assets/images/maintenence_page.jpg" height="80%">
    </div>   
@endif