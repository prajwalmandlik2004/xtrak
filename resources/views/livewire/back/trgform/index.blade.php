<div>
    <div class="row">
        <div>
            <div class="modal-content">
                <div class="modal-header">
                    <h2>TRGform</h2>
                </div>
                <div>
                    <div class="form-row">
                        <div class="form-group date-field">
                            <label>Date</label>
                            <input type="date" class="form-control1" value="">
                        </div>
                        <div class="form-group type-field">
                            <label>Auth</label>
                            <input type="text" class="form-control1">
                        </div>
                        <div class="form-group objet-field">
                            <label>Company</label>
                            <input type="text" class="form-control1">
                        </div>
                        <div class="form-group date-field">
                            <label>Std</label>
                            <input type="text" class="form-control1">
                        </div>
                        <div class="form-group date-field">
                            <label>Url</label>
                            <input type="text" class="form-control1">
                        </div>
                        <div class="form-group date-field">
                            <label>TRGcode</label>
                            <input type="text" class="form-control1">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group objet-field">
                            <label>Address1</label>
                            <input type="text" class="form-control1">
                        </div>
                        <div class="form-group objet-field">
                            <label>Address2</label>
                            <input type="text" class="form-control1">
                        </div>
                        <div class="form-group date-field">
                            <label>CP/Dpt</label>
                            <input type="text" class="form-control1" value="">
                        </div>
                        <div class="form-group date-field">
                            <label>Area</label>
                            <input type="text" class="form-control1">
                        </div>
                        <div class="form-group date-field">
                            <label>Town</label>
                            <input type="text" class="form-control1">
                        </div>
                        <div class="form-group date-field">
                            <label>Country</label>
                            <input type="text" class="form-control1">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group date-field">
                            <label>CA (K)</label>
                            <input type="text" class="form-control1" value="">
                        </div>
                        <div class="form-group date-field">
                            <label>Staff</label>
                            <input type="text" class="form-control1" value="">
                        </div>
                        <div class="form-group date-field">
                            <label>Activity</label>
                            <input type="text" class="form-control1">
                        </div>
                        <div class="form-group date-field">
                            <label>Type</label>
                            <input type="text" class="form-control1" value="">
                        </div>
                        <div class="form-group objet-field">
                            <label>SIRET</label>
                            <input type="text" class="form-control1">
                        </div>
                        <div class="form-group objet-field">
                            <label>RCS</label>
                            <input type="text" class="form-control1">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group date-field">
                            <label>Filiation</label>
                            <input type="text" class="form-control1" value="">
                        </div>
                        <div class="form-group date-field">
                            <label>OF</label>
                            <input type="text" class="form-control1">
                        </div>
                        <div class="form-group date-field">
                            <label>Form</label>
                            <input type="text" class="form-control1" value="">
                        </div>
                        <div class="form-group objet-field">
                            <label>VAT#</label>
                            <input type="text" class="form-control1">
                        </div>
                        <div class="form-group objet-field">
                            <label>TRG Status</label>
                            <input type="text" class="form-control1">
                        </div>
                    </div>

                    <div class="comment-section">
                        <div class="form-group comment-field">
                            <label>Remark(s)</label>
                            <textarea class="form-control2"></textarea>
                        </div>
                        <div class="form-group comment-field">
                            <label>Note(s)</label>
                            <textarea class="form-control2"></textarea>
                        </div>
                        <div class="right-section">
                            <div class="next-ech-row">
                                <div class="form-group next-field">
                                    <label>LM Sent.</label>
                                    <input type="text" class="form-control1">
                                </div>
                                <div class="form-group ech-field">
                                    <label>Prio.</label>
                                    <input type="text" class="form-control1">
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="button-group">
                        <div class="button-group-left">
                            <a href="/trgform">
                                <button style="background:#999;color:white;" type="button" class="btn btn-evt">New TRG</button>
                            </a>
                            <div class="one"> <button type="button" class="btn btn-evt">EVTlist</button>
                                <button type="button" class="btn btn-evt"> > New</button>
                            </div>
                            <div class="two">
                                <button type="button" class="btn btn-input">CTClist</button>
                                <button type="button" class="btn btn-input"> > New</button>
                            </div>
                            <div class="three"><button style="background:#4CC9FE; color:black;" type="button" class="btn btn-valid">Save</button>
                                <button type="button" class="btn btn-erase" onclick="eraseForms()">Erase</button>
                                <button type="button" class="btn btn-inputmain">Input</button>
                            </div>
                            <button type="button" class="btn btn-close1" onclick="closeModal()">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script>

    </script>
    <style>
        .modal-content {
            background: none;
            border-radius: 8px;
            width: 300px;
        }

        .modal {
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .modal-content {
            background-color: #fff;
            padding: 20px 25px;
            width: 80%;
            max-width: 1500px;
            border-radius: 2px;

        }

        .modal-header {
            margin-bottom: 5px;
            margin-left: -12px;
            text-align: center;
        }

        .modal-header h2 {
            color: #333;
            font-size: 1.4em;
            font-weight: 500;
            /* margin-right: 10px; */
            text-align: center;
        }

        .icons-row {
            display: flex;
            gap: 25px;
            margin-top: 5px;
            margin-bottom: -20px;
            padding-left: 5px;
        }

        .icon-item {
            font-size: 18px;
            color: #555;
        }

        .divider {
            height: 1px;
            background-color: #ddd;
            margin: 12px 0;
        }

        .status-buttons {
            display: flex;
            gap: 20px;
            margin-top: -5px;
            margin-bottom: 20px;
            font-size: 1rem;
            justify-content: flex-end;
        }

        .status-btn {
            padding: 2px 8px;
            border: none;
            text-decoration: underline;
            background: none;
            cursor: pointer;
            font-weight: 500;
            color: #333;
            font-size: 0.9em;
        }

        .form-row {
            display: flex;
            gap: 15px;
            margin-top: 5px;
            margin-bottom: 15px;
            align-items: flex-start;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .date-field {
            width: 90px;
        }

        .type-field {
            width: 60px;
        }

        .io-field {
            width: 60px;
        }

        .date-field {
            width: 115px;
        }

        .objet-field {
            width: 170px;
        }

        .retour-field {
            width: 200px;
        }

        .last-field {
            width: 300px;
        }

        .statut-field {
            width: 80px;
        }

        .comment-section {
            display: flex;
            gap: 15px;
        }

        .comment-field {
            flex: 1;
            max-width: 60%;
        }

        .right-section {
            flex: 1;
            max-width: 40%;
        }

        .next-ech-row {
            display: flex;
            gap: 15px;
            margin-bottom: 10px;
        }

        .next-field,
        .ech-field {
            /* flex: 1; */
            width: 80px;
        }

        label {
            color: black;
            margin-left: 2px;
        }

        .form-control1 {
            width: 100%;
            padding: 8px 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 13px;
            background-color: #f8f8f8;
        }

        .form-control2 {
            width: 100%;
            padding: 6px 8px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 13px;
            background-color: #f8f8f8;
        }

        textarea.form-control1 {
            min-height: 60px;
            resize: vertical;
        }

        textarea.form-control2 {
            min-height: 67px;
            resize: vertical;
        }

        .button-group {
            display: flex;
            justify-content: space-between;
            margin-top: 3%;
            padding: 0 20px;
        }

        .button-group-left {
            display: flex;
            gap: 50px;
        }

        .button-group-right {
            display: flex;
        }

        .btn-input {
            background-color: #00c853;
            color: black;
        }

        .btn-inputmain {
            background-color: green;
            color: white;
        }

        .btn-inputmain:hover {
            background-color: green;
            color: white;
        }

        .btn-input:hover {
            background-color: #00c853;
            color: black;
        }

        .btn-erase {
            background-color: #ff5722;
            color: white;
        }

        .btn-valid {
            background-color: #6F61C0;
            color: white;
        }

        .btn-evt {
            background-color: #F9C0AB;
            color: black;
        }

        .btn-evt:hover {
            background-color: #F9C0AB;
            color: black;
        }

        .btn-valid:hover {
            background-color: #6F61C0;
            color: white;
        }

        .btn-erase:hover {
            background-color: #ff5722;
            color: white;
        }

        .btn-historique {
            background-color: #2196f3;
            color: white;
        }

        .btn-historique:hover {
            background-color: #2196f3;
            color: white;
        }

        .btn-close1 {
            background-color: #000080;
            color: white;
        }

        .btn-close1:hover {
            background-color: #000080;
            color: white;
        }


        .evt-button {
            background: #FF77B7;
            border: none;
            color: white;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
        }

        .evt-button i {
            font-size: 14px;
        }
    </style>

</div>
