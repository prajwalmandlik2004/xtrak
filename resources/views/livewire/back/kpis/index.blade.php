<div class="p-6 bg-gray-100 min-h-screen">
    @include('components.breadcrumb', [
    'title' => auth()->user()->hasRole('Administrateur') ? 'Espace Administrateur' : (
    auth()->user()->hasRole('Manager') ? 'Espace Manager' : (
    auth()->user()->hasRole('CST+') ? 'Espace Consultant+' : 'Espace Consultant'
    )
    ),
    'breadcrumbItems' => [['text' => 'KPIs', 'url' => '#']],
    ])

    <div class="heading">
        <h4 class="headDate">KPIs - <span id="date"></span></h4>
        <h5 class="tableHead">Table - Graphs <span class="objectives" onclick="openModal('objModal')"> Objectives </span></h5>
    </div>

    <div class="kpi-section">
        <h6 class="section-title">TARGETS</h6>
        <div class="table-container">
            <table class="kpi-table">
                <thead>
                    <tr>
                        <th rowspan="2">N of</th>
                        <th style="border-right:2px solid black;" colspan="3">Last day : <span id="dateTRG"></span></th>
                        <th style="border-right:2px solid black;" colspan="3">Last 7 days</th>
                        <th style="border-right:2px solid black;" colspan="3">Last 30 days</th>
                        <th style="border-right:2px solid black;" colspan="3">Last 12 months</th>
                        <th colspan="3">Overall</th>
                    </tr>
                    <tr>
                        <th>Done</th>
                        <th>Obj</th>
                        <th style="border-right:2px solid black;">Gap</th>
                        <th>Avg</th>
                        <th>Obj</th>
                        <th style="border-right:2px solid black;">Gap</th>
                        <th>Avg</th>
                        <th>Obj</th>
                        <th style="border-right:2px solid black;">Gap</th>
                        <th>Avg</th>
                        <th>Obj</th>
                        <th style="border-right:2px solid black;">Gap</th>
                        <th>Avg</th>
                        <th>Obj</th>
                        <th>Gap</th>
                    </tr>
                </thead>
                <tbody id="kpiTableBody">
                    <tr>
                        <td>Calls</td>
                        <td></td>
                        <td contenteditable="false"></td>
                        <td style="font-weight:bold; border-right:2px solid black;" contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td style="font-weight:bold; border-right:2px solid black;" contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td style="font-weight:bold; border-right:2px solid black;" contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td style="font-weight:bold; border-right:2px solid black;" contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td contenteditable="false"></td>
                    </tr>
                    <tr>
                        <td>WN</td>
                        <td contenteditable="false"></td>
                        <td class="dark" contenteditable="false"></td>
                        <td style="font-weight:bold; border-right:2px solid black;" contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td class="dark" contenteditable="false"></td>
                        <td style="font-weight:bold; border-right:2px solid black;" contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td class="dark" contenteditable="false"></td>
                        <td style="font-weight:bold; border-right:2px solid black;" contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td class="dark" contenteditable="false"></td>
                        <td style="font-weight:bold; border-right:2px solid black;" contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td class="dark" contenteditable="false"></td>
                        <td contenteditable="false"></td>
                    </tr>
                    <tr>
                        <td>NRP</td>
                        <td contenteditable="false"></td>
                        <td class="dark" contenteditable="false"></td>
                        <td style="font-weight:bold; border-right:2px solid black;" contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td class="dark" contenteditable="false"></td>
                        <td style="font-weight:bold; border-right:2px solid black;" contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td class="dark" contenteditable="false"></td>
                        <td style="font-weight:bold; border-right:2px solid black;" contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td class="dark" contenteditable="false"></td>
                        <td style="font-weight:bold; border-right:2px solid black;" contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td class="dark" contenteditable="false"></td>
                        <td contenteditable="false"></td>
                    </tr>
                    <tr>
                        <td>CTC</td>
                        <td contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td style="font-weight:bold; border-right:2px solid black;" contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td style="font-weight:bold; border-right:2px solid black;" contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td style="font-weight:bold; border-right:2px solid black;" contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td style="font-weight:bold; border-right:2px solid black;" contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td contenteditable="false"></td>
                    </tr>
                    <tr>
                        <td>RV</td>
                        <td contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td style="font-weight:bold; border-right:2px solid black;" contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td style="font-weight:bold; border-right:2px solid black;" contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td style="font-weight:bold; border-right:2px solid black;" contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td style="font-weight:bold; border-right:2px solid black;" contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td contenteditable="false"></td>
                    </tr>
                    <tr>
                        <td>BQF</td>
                        <td contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td style="font-weight:bold; border-right:2px solid black;" contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td style="font-weight:bold; border-right:2px solid black;" contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td style="font-weight:bold; border-right:2px solid black;" contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td style="font-weight:bold; border-right:2px solid black;" contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td contenteditable="false"></td>
                    </tr>
                    <tr>
                        <td>KLF</td>
                        <td contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td style="font-weight:bold; border-right:2px solid black;" contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td style="font-weight:bold; border-right:2px solid black;" contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td style="font-weight:bold; border-right:2px solid black;" contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td style="font-weight:bold; border-right:2px solid black;" contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td contenteditable="false"></td>
                    </tr>
                    <tr>
                        <td>HRD</td>
                        <td contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td style="font-weight:bold; border-right:2px solid black;" contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td style="font-weight:bold; border-right:2px solid black;" contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td style="font-weight:bold; border-right:2px solid black;" contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td style="font-weight:bold; border-right:2px solid black;" contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td contenteditable="false"></td>
                    </tr>
                </tbody>
            </table>
            <button class="capture-btn" onclick="openModal('trgModal')">Capture</button>
        </div>
    </div>

    <div class="kpi-section">
        <h6 class="section-title">CANDIDATES</h6>
        <div class="table-container">
            <table class="kpi-table">
                <thead>
                    <tr>
                        <th rowspan="2">N</th>
                        <th style="border-right:2px solid black;" colspan="3">Last day : <span id="dateCDT"></span></th>
                        <th style="border-right:2px solid black;" colspan="3">Last 7 days</th>
                        <th style="border-right:2px solid black;" colspan="3">Last 30 days</th>
                        <th style="border-right:2px solid black;" colspan="3">Last 12 months</th>
                        <th colspan="3">Overall</th>
                    </tr>
                    <tr>
                        <th>Done</th>
                        <th>Obj</th>
                        <th style="border-right:2px solid black;">Gap</th>
                        <th>Avg</th>
                        <th>Obj</th>
                        <th style="border-right:2px solid black;">Gap</th>
                        <th>Avg</th>
                        <th>Obj</th>
                        <th style="border-right:2px solid black;">Gap</th>
                        <th>Avg</th>
                        <th>Obj</th>
                        <th style="border-right:2px solid black;">Gap</th>
                        <th>Avg</th>
                        <th>Obj</th>
                        <th>Gap</th>
                    </tr>
                </thead>
                <tbody id="kpiTableBodyCDT">
                    <tr>
                        <td>Calls</td>
                        <td contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td style="font-weight:bold; border-right:2px solid black;" contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td style="font-weight:bold; border-right:2px solid black;" contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td style="font-weight:bold; border-right:2px solid black;" contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td style="font-weight:bold; border-right:2px solid black;" contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td contenteditable="false"></td>
                    </tr>
                    <tr>
                        <td>CTC</td>
                        <td contenteditable="false"></td>
                        <td class="darkCDT" contenteditable="false"></td>
                        <td style="font-weight:bold; border-right:2px solid black;" contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td style="font-weight:bold; border-right:2px solid black;" contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td style="font-weight:bold; border-right:2px solid black;" contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td style="font-weight:bold; border-right:2px solid black;" contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td contenteditable="false"></td>
                    </tr>
                    <tr>
                        <td>REFS</td>
                        <td contenteditable="false"></td>
                        <td class="darkCDT" contenteditable="false"></td>
                        <td style="font-weight:bold; border-right:2px solid black;" contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td style="font-weight:bold; border-right:2px solid black;" contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td style="font-weight:bold; border-right:2px solid black;" contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td style="font-weight:bold; border-right:2px solid black;" contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td contenteditable="false"></td>
                    </tr>
                    <tr>
                        <td>CV</td>
                        <td contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td style="font-weight:bold; border-right:2px solid black;" contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td style="font-weight:bold; border-right:2px solid black;" contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td style="font-weight:bold; border-right:2px solid black;" contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td style="font-weight:bold; border-right:2px solid black;" contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td contenteditable="false"></td>
                    </tr>
                    <tr>
                        <td>Push</td>
                        <td contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td style="font-weight:bold; border-right:2px solid black;" contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td style="font-weight:bold; border-right:2px solid black;" contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td style="font-weight:bold; border-right:2px solid black;" contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td style="font-weight:bold; border-right:2px solid black;" contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td contenteditable="false"></td>
                        <td contenteditable="false"></td>
                    </tr>
                </tbody>
            </table>
            <button class="capture-btn" onclick="openModal('cdtModal')">Capture</button>
        </div>
    </div>

    <div id="trgModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <div class="date-section">
                    <label>Date:</label>
                    <input style="width:115px;" type="date" id="trgDate">
                </div>
                <!-- <div class="obj-section">
                    <label>Obj</label>
                    <input type="text" id="trgObj">
                </div> -->
            </div>
            <h2 class="modal-title">TRG CAPTION REPORT</h2>
            <div class="modal-body">
                <div class="metrics-grid" id="metricsForm">
                    <div class="column-labels">
                        <div class="label-data">Data</div>
                        <div class="label-obj">Obj</div>
                    </div>
                    <div class="metric-row">
                        <label>Calls :</label>
                        <div class="input-pair">
                            <input type="number" name="calls_done" placeholder="">
                            <input type="number" name="calls_obj" placeholder="">
                        </div>
                    </div>
                    <div class="metric-row">
                        <label>N.I. :</label>
                        <div class="input-pair">
                            <input type="number" name="wn_done" placeholder="">
                            <!-- <input type="number" name="wn_obj" placeholder=""> -->
                        </div>
                    </div>
                    <div class="metric-row">
                        <label>NRP :</label>
                        <div class="input-pair">
                            <input type="number" name="nrp_done" placeholder="">
                            <!-- <input type="number" name="nrp_obj" placeholder=""> -->
                        </div>
                    </div>
                    <div class="metric-row">
                        <label>CTC :</label>
                        <div class="input-pair">
                            <input type="number" name="ctc_done" placeholder="">
                            <input type="number" name="ctc_obj" placeholder="">
                        </div>
                    </div>
                    <div class="metric-row">
                        <label>RV :</label>
                        <div class="input-pair">
                            <input type="number" name="rv_done" placeholder="">
                            <input type="number" name="rv_obj" placeholder="">
                        </div>
                    </div>
                    <div class="metric-row">
                        <label>BQF :</label>
                        <div class="input-pair">
                            <input type="number" name="bqf_done" placeholder="">
                            <input type="number" name="bqf_obj" placeholder="">
                        </div>
                    </div>
                    <div class="metric-row">
                        <label>KLF :</label>
                        <div class="input-pair">
                            <input type="number" name="klf_done" placeholder="">
                            <input type="number" name="klf_obj" placeholder="">
                        </div>
                    </div>
                    <div class="metric-row">
                        <label>HRD :</label>
                        <div class="input-pair">
                            <input type="number" name="hrd_done" placeholder="">
                            <input type="number" name="hrd_obj" placeholder="">
                        </div>
                    </div>
                </div>
                <div class="modal-buttons">
                    <button class="btn btn-erase" onclick="eraseModalData()">Clear All</button>
                    <button class="btn btn-save" onclick="saveModalData()">Capture</button>
                    <button class="btn btn-end" onclick="closeModal('trgModal')">Close</button>
                    <!-- <button class="btn btn-close" onclick="closeModal('trgModal')">Close</button> -->
                </div>
                <!-- <div class="notes-section">
                    <label>Note(s):</label>
                    <textarea id="trgNotes"></textarea>
                </div> -->
            </div>
        </div>
    </div>


    <div id="cdtModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <div class="date-section">
                    <label>Date :</label>
                    <input style="width:115px;" type="date" id="cdtDate">
                </div>
                <!-- <div class="obj-section">
                    <label>Obj</label>
                    <input type="text" id="trgObj">
                </div> -->
            </div>
            <h2 class="modal-title">CDT CAPTION REPORT</h2>
            <div class="modal-body">
                <div class="metrics-grid" id="metricsFormCDT">
                    <div class="column-labels">
                        <div class="label-data">Data</div>
                        <div class="label-obj">Obj</div>
                    </div>
                    <div class="metric-row">
                        <label>Calls :</label>
                        <div class="input-pair">
                            <input type="number" name="calls_done_cdt" placeholder="">
                            <input type="number" name="calls_obj_cdt" placeholder="">
                        </div>
                    </div>
                    <div class="metric-row">
                        <label>CTC :</label>
                        <div class="input-pair">
                            <input type="number" name="ctc_done_cdt" placeholder="">
                            <!-- <input type="text"> -->
                        </div>
                    </div>
                    <div class="metric-row">
                        <label>REFS :</label>
                        <div class="input-pair">
                            <input type="number" name="refs_done_cdt" placeholder="">
                            <!-- <input type="text"> -->
                        </div>
                    </div>
                    <div class="metric-row">
                        <label>CV :</label>
                        <div class="input-pair">
                            <input type="number" name="cv_done_cdt" placeholder="">
                            <input type="number" name="cv_obj_cdt" placeholder="">
                        </div>
                    </div>
                    <div class="metric-row">
                        <label>Push :</label>
                        <div class="input-pair">
                            <input type="number" name="push_done_cdt" placeholder="">
                            <input type="number" name="push_obj_cdt" placeholder="">
                        </div>
                    </div>
                </div>
                <!-- <div class="notes-section">
                    <label>Note(s):</label>
                    <textarea id="trgNotes"></textarea>
                </div> -->
                <div class="modal-buttons">
                    <button class="btn btn-erase" onclick="eraseModalDataCDT()">Clear All</button>
                    <button class="btn btn-save" onclick="saveModalDataCDT()">Capture</button>
                    <button class="btn btn-end" onclick="closeModal('cdtModal')">Close</button>
                </div>
            </div>
        </div>
    </div>




    <div id="objModal" class="modal">
        <div class="modal-content">
            <h2 class="modal-titleObj">OBJECTIVES DEFINITION</h2>
            <hr>
            <div class="date-sectionObj">
                <label>Last definition date :</label>
                <input type="text" id="trgDate">
            </div>
            <div class="obj-sectionObj">
                <label>Last frequency :</label>
                <input type="text" id="trgObj">
            </div>
            <div class="modal-body">
                <div class="metrics-grid">
                    <div class="column-labelsObj">
                        <div class="label-dataObj">TRG</div>
                        <div class="label-objObj">CDT</div>
                    </div>
                    <div class="metric-row">
                        <label>Calls :</label>
                        <div class="input-pair">
                            <input class="objinput" type="text">
                            <label>Calls :</label>
                            <input class="objinput" type="text">
                        </div>
                    </div>
                    <div class="metric-row">
                        <label>CTC :</label>
                        <div class="input-pair">
                            <input class="objinput" type="text">
                            <label>CTC :</label>
                            <input class="objinput" type="text">
                        </div>
                    </div>
                    <div class="metric-row">
                        <label>RV:</label>
                        <div class="input-pair">
                            <input class="objinput" type="text">
                            <label>CRE :</label>
                            <input class="objinput" type="text">
                        </div>
                    </div>
                    <div class="metric-row">
                        <label>Calls :</label>
                        <div class="input-pair">
                            <input class="objinput" type="text">
                            <label>REFS :</label>
                            <input class="objinput" type="text">
                        </div>
                    </div>
                    <div class="metric-row">
                        <label>CTC :</label>
                        <div class="input-pair">
                            <input class="objinput" type="text">
                            <label>CV :</label>
                            <input class="objinput" type="text">
                        </div>
                    </div>
                    <div class="metric-row">
                        <label>RV :</label>
                        <div class="input-pair">
                            <input class="objinput" type="text">
                            <label>Push :</label>
                            <input class="objinput" type="text">
                        </div>
                    </div>
                    <div class="metric-row">
                        <label>BQF :</label>
                        <div class="input-pair">
                            <input type="text">
                            <!-- <input type="text"> -->
                        </div>
                    </div>
                    <div class="metric-row">
                        <label>KLF :</label>
                        <div class="input-pair">
                            <input type="text">
                            <!-- <input type="text"> -->
                        </div>
                    </div>
                    <div class="metric-row">
                        <label>HRD :</label>
                        <div class="input-pair">
                            <input type="text">
                            <!-- <input type="text"> -->
                        </div>
                    </div>
                </div>
                <!-- <div class="notes-section">
                    <label>Note(s):</label>
                    <textarea id="trgNotes"></textarea>
                </div> -->
                <div class="modal-buttons">
                    <button class="btn btn-erase" onclick="eraseModalDataOBJ()">Clear All</button>
                    <button class="btn btn-save" onclick="saveModalData()">Capture</button>
                    <button class="btn btn-end" onclick="closeModal('objModal')">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const todaysDate = new Date().toLocaleDateString();
        document.getElementById("date").innerText = todaysDate;
        document.getElementById("dateTRG").innerText = todaysDate;
        document.getElementById("dateCDT").innerText = todaysDate;

        function openModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.style.display = "block";

            const dateInput = modal.querySelector('input[id$="Date"]');
            if (dateInput) {
                dateInput.value = new Date().toLocaleDateString('en-GB');
            }
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.style.display = "none";
        }


        function eraseModalData() {
            const modal = document.getElementById('trgModal');
            const modalcdt = document.getElementById('cdtModal');
            const inputs = modal.querySelectorAll('input, textarea');
            const inputscdt = modal.querySelectorAll('input, textarea');

            inputs.forEach(input => {
                input.value = '';
            });

            inputscdt.forEach(input => {
                input.value = '';
            });
        }

        function eraseModalDataCDT() {
            const modal = document.getElementById('cdtModal');
            const inputs = modal.querySelectorAll('input, textarea');
            inputs.forEach(input => {
                input.value = '';
            });
        }

        function eraseModalDataOBJ() {
            const modal = document.getElementById('objModal');
            const inputs = modal.querySelectorAll('input, textarea');
            inputs.forEach(input => {
                input.value = '';
            });
        }

        window.onclick = function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.style.display = "none";
            }
        }


        // Local Storage Setup for Target :

        if (!localStorage.getItem('kpiData')) {
            localStorage.setItem('kpiData', JSON.stringify([]));
        }

        function openModal(modalId) {
            document.getElementById(modalId).style.display = 'block';
            document.getElementById('trgDate').valueAsDate = new Date();
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        function eraseModalData() {
            const form = document.getElementById('metricsForm');
            const inputs = form.querySelectorAll('input');
            inputs.forEach(input => input.value = '');
        }

        function calculateGap(done, objective) {
            const mainGap = (done / objective) * 100;
            const gaps = Math.round(mainGap);
            const gap = Math.abs(done && objective ? gaps : '');
            return `${gap} %`;
        }

        function saveModalData() {
            const date = document.getElementById('trgDate').value;
            const metrics = ['calls', 'wn', 'nrp', 'ctc', 'rv', 'bqf', 'klf', 'hrd'];
            const data = {
                date: date,
                metrics: {}
            };

            metrics.forEach(metric => {
                const done = document.querySelector(`[name="${metric}_done"]`)?.value || '';
                const obj = document.querySelector(`[name="${metric}_obj"]`)?.value || '';
                data.metrics[metric] = {
                    done: done,
                    objective: obj,
                    gap: calculateGap(Number(done), Number(obj))
                };
            });

            let kpiData = JSON.parse(localStorage.getItem('kpiData'));
            const existingIndex = kpiData.findIndex(item => item.date === date);

            if (existingIndex !== -1) {
                kpiData[existingIndex] = data;
            } else {
                kpiData.push(data);
            }

            localStorage.setItem('kpiData', JSON.stringify(kpiData));

            updateTable(data);

            closeModal('trgModal');
        }

        function updateTable(data) {
            // document.getElementById('dateTRG').textContent = new Date(data.date).toLocaleDateString();

            const tbody = document.getElementById('kpiTableBody');
            const metrics = ['calls', 'wn', 'nrp', 'ctc', 'rv', 'bqf', 'klf', 'hrd'];

            metrics.forEach((metric, index) => {
                const row = tbody.rows[index];
                const metricData = data.metrics[metric];

                row.cells[1].textContent = metricData.done;
                row.cells[2].textContent = metricData.objective;
                row.cells[3].textContent = metricData.gap;
            });
        }




        // Local Storage Setup for Candidate :


        if (!localStorage.getItem('kpiDataCDT')) {
            localStorage.setItem('kpiDataCDT', JSON.stringify([]));
        }

        function openModalCDT(modalId) {
            document.getElementById(modalId).style.display = 'block';
            document.getElementById('cdtDate').valueAsDate = new Date();
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        function eraseModalDataCDT() {
            const form = document.getElementById('metricsFormCDT');
            const inputs = form.querySelectorAll('input');
            inputs.forEach(input => input.value = '');
        }

        function calculateGapCDT(done, objective) {
            const mainGap = (done / objective) * 100;
            const gaps = Math.round(mainGap);
            const gap = Math.abs(done && objective ? gaps : '');
            return `${gap}%`;
        }

        function saveModalDataCDT() {
            const date = document.getElementById('cdtDate').value;
            const metrics = ['calls', 'ctc', 'refs', 'cv', 'push'];
            const data = {
                date: date,
                metrics: {}
            };

            metrics.forEach(metric => {
                const done = document.querySelector(`[name="${metric}_done_cdt"]`)?.value || '';
                const obj = document.querySelector(`[name="${metric}_obj_cdt"]`)?.value || '';
                data.metrics[metric] = {
                    done: done,
                    objective: obj,
                    gap: calculateGapCDT(Number(done), Number(obj))
                };
            });

            let kpiDataCDT = JSON.parse(localStorage.getItem('kpiDataCDT'));
            const existingIndex = kpiDataCDT.findIndex(item => item.date === date);

            if (existingIndex !== -1) {
                kpiDataCDT[existingIndex] = data;
            } else {
                kpiDataCDT.push(data);
            }

            localStorage.setItem('kpiDataCDT', JSON.stringify(kpiDataCDT));

            updateTableCDT(data);

            closeModal('cdtModal');
        }

        function updateTableCDT(data) {
            // document.getElementById('dateTRG').textContent = new Date(data.date).toLocaleDateString();

            const tbody = document.getElementById('kpiTableBodyCDT');
            const metrics = ['calls', 'ctc', 'refs', 'cv', 'push'];
            metrics.forEach((metric, index) => {
                const row = tbody.rows[index];
                const metricDataCDT = data.metrics[metric];

                row.cells[1].textContent = metricDataCDT.done;
                row.cells[2].textContent = metricDataCDT.objective;
                row.cells[3].textContent = metricDataCDT.gap;
            });
        }

        window.onload = function() {
            const kpiDataCDT = JSON.parse(localStorage.getItem('kpiDataCDT'));
            const kpiData = JSON.parse(localStorage.getItem('kpiData'));
            if (kpiDataCDT && kpiDataCDT.length > 0) {
                const mostRecent = kpiDataCDT[kpiDataCDT.length - 1];
                updateTableCDT(mostRecent);
            }

            if (kpiData && kpiData.length > 0) {
                const mostRecent = kpiData[kpiData.length - 1];
                updateTable(mostRecent);
            }
        };
    </script>


    <style>
        .headDate {
            color: #010066;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .objinput {
            margin-top: 8px;
        }

        .tableHead {
            text-align: center;
            margin-bottom: 15px;
        }

        .objectives {
            margin-left: 10px;
            cursor: pointer;
        }

        .dark {
            /* background-color: #f5f5f5; */
            background-color: #D8D9DA;
        }

        .darkCDT {
            background-color: #D1F8EF;
        }

        .kpi-section {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        label {
            font-size: 1rem;
            margin-top: 8px;
        }

        .section-title {
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .table-container {
            overflow-x: auto;
        }

        .kpi-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        .kpi-table th,
        .kpi-table td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }

        .kpi-table th {
            background-color: #f5f5f5;
            font-weight: bold;
        }

        .kpi-table td[contenteditable="false"] {
            /* background-color: #fff; */
            cursor: text;
            min-width: 60px;
        }

        .kpi-table td[contenteditable="false"]:focus {
            outline: 2px solid #4299e1;
            outline-offset: -2px;
        }

        .capture-btn {
            position: absolute;
            bottom: 8px;
            right: 20px;
            background-color: green;
            color: white;
            border: none;
            padding: 6px 14px;
            border-radius: 2px;
            cursor: pointer;
        }


        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
        }

        .modal-content {
            background-color: #e6e6e6;
            margin: 5% auto;
            padding: 5px;
            width: 400px;
            position: relative;
            border: 1px solid #999;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }

        .date-section,
        .obj-section {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .date-section input,
        .obj-section input {
            width: 100px;
            height: 25px;
            border: 1px solid #999;
        }

        .date-sectionObj {
            display: flex;
            align-items: center;
            gap: 5px;
            margin-left: 25px;
        }

        .obj-sectionObj {
            display: flex;
            align-items: center;
            gap: 5px;
            margin-left: 25px;
        }

        .date-sectionObj input {
            width: 100px;
            height: 25px;
            margin-left: 30px;
            border: 1px solid #999;
        }

        .obj-sectionObj input {
            width: 100px;
            height: 25px;
            margin-left: 61px;
            border: 1px solid #999;
        }

        .modal-title {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            /* margin: 15px 0; */
        }

        .modal-titleObj {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            margin-top: 15px;
            /* margin: 15px 0; */
        }

        .modal-buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 15px;
        }

        .btn {
            padding: 6px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 500;
        }

        .btn-save {
            background-color: #48bb78;
            color: white;
        }

        .btn-save:hover {
            background-color: #48bb78;
            color: white;
        }

        .btn-erase {
            background-color: #f56565;
            color: white;
        }

        .btn-erase:hover {
            background-color: #f56565;
            color: white;
        }

        .btn-end {
            background-color: #4299e1;
            color: white;
        }

        .btn-end:hover {
            background-color: #4299e1;
            color: white;
        }

        .metric-row {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
        }

        .metric-row label {
            width: 50px;
            text-align: right;
            margin-right: 10px;
        }

        .input-pair {
            display: flex;
            gap: 10px;
        }

        .input-pair input {
            width: 80px;
            height: 25px;
            border: 1px solid #999;
        }

        .notes-section {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .notes-section label {
            margin-bottom: 5px;
        }

        .notes-section textarea {
            width: 100%;
            height: 60px;
            border: 1px solid #999;
            resize: none;
        }

        input,
        textarea {
            background-color: white;
            padding: 4px;
        }

        input:focus,
        textarea:focus {
            outline: 1px solid #666;
        }

        label {
            font-weight: normal;
            color: #000;
        }

        .column-labels {
            display: flex;
            margin-bottom: 5px;
            padding-left: 60px;
        }

        .label-data,
        .label-obj {
            width: 80px;
            text-align: center;
            font-weight: 500;
            font-size: 1rem;
        }

        .column-labelsObj {
            display: flex;
            margin-bottom: 5px;
            padding-left: 60px;
        }

        .label-dataObj,
        .label-objObj {
            width: 80px;
            text-align: center;
            font-weight: 500;
            font-size: 1rem;
        }

        .label-objObj {
            margin-left: 80px;
        }

        .column-labels {
            display: flex;
            gap: 10px;

        }

        .metric-row {
            display: flex;
            align-items: center;
            margin-bottom: 1px;
        }

        .metric-row label {
            width: 50px;
            text-align: right;
            margin-right: 10px;
        }

        .input-pair {
            display: flex;
            gap: 10px;
        }

        .input-pair input {
            width: 80px;
            height: 25px;
            border: 1px solid #999;
        }
    </style>

</div>
